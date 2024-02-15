<?php
// RegisterationController.php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SequenceService;
use Illuminate\Support\Facades\Hash;
use App\Models\Party; // Import the Party model
use App\Models\Person; // Import the Person model
use App\Models\ContactMech;  // Import the ContactMech model
use App\Models\TelecomNumber; // Import the TelecomNumber  model 
use App\Models\PostalAddress; // Import the PostalAddress  model 
use App\Models\UserLogin; // Import the PostalAddress  model 
use App\Models\PartyContactMech; // Import the PartyContactMech  model 
use App\Models\PartyContactMechPurpose; // Import the PartyContactMechPurpose  model 
use App\Models\DataResource; // Import the PartyContactMechPurpose  model 
use App\Models\ImageDataResource; // Import the ImageDataResource  model 
use App\Models\PdfDataResource; // Import the PdfDataResource  model 
use App\Models\Content; // Import the Content  model 
use App\Models\PartyContent; // Import the Content  model 
use Illuminate\Support\Facades\Session;


class RegisterationController extends Controller
{
    protected $sequenceService;
    public function __construct(SequenceService $sequenceService)
    {
        $this->sequenceService = $sequenceService;
    }
    public function index()
    {
        return view('registration_form');
    }
    public function register(Request $request)
    {
        //validation of Registeration form
        $request->validate([
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'emailaddress' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'address1' => 'required',
            'address2' => 'required',
            'phonenumber' => 'required|numeric|digits:10',
            'sec_phonenumber' => 'numeric|digits:10',
        ]);

        // Check if the phone number exists in the database
        $existingPhoneNumber = TelecomNumber::where('CONTACT_NUMBER', $request->phonenumber)->first();

        if ($existingPhoneNumber) {
            // Phone number exists in the database
            $contactMechId = $existingPhoneNumber->CONTACT_MECH_ID;
            echo "Phone number already exists";
            // Perform actions based on the existence of the phone number
        } else {
            // Phone number does not exist in the database
            // Create a new party instance and set the values
            $party = new Party();
            $partyId = $this->sequenceService->getNextSequenceValue('Party');
            $party->PARTY_ID = $partyId; // Set the PARTY_ID value
            $party->PARTY_TYPE_ID = 'PERSON';
            Session::put('PARTY_ID', $partyId);//this session is added on 15/02
            $party->save();

            // Create user login
            $userLogin = new UserLogin();
            $userLogin->USER_LOGIN_ID = $request['phonenumber'];
            $userLogin->CURRENT_PASSWORD = Hash::make($request->input('password'));
            $userLogin->PARTY_ID = $partyId; // Set the PARTY_ID value
            Session::put('USER_LOGIN_ID', $request['phonenumber']);
            $userLogin->save();

            // Create a new person instance and set the values
            $person = new Person();
            $person->PARTY_ID = $partyId; // Set the PARTY_ID value
            $person->FIRST_NAME = $request['first_name'];
            $person->LAST_NAME = $request['last_name'];
            Session::put('FIRST_NAME', $request['first_name']);
            Session::put('LAST_NAME', $request['last_name']);
            $person->save();

            // Save contact mechanism information
            $this->saveContactMechanisms($request, $partyId);
        }
    }

    private function saveContactMechanisms($request, $partyId)
    {
        // Define the associative array to store contact mechanism information
        $contactMechArray = [
            'TELECOM_NUMBER' => 'NULL',
            'EMAIL_ADDRESS' => $request['emailaddress'],
            'POSTAL_ADDRESS' => 'NULL'
        ];

        foreach ($contactMechArray as $mechType => $mechValue) {
            // Create a new contact_mech instance
            $contactMech = new ContactMech();

            // Set the values for the instance
            $contactMechId = $this->sequenceService->getNextSequenceValue('ContactMech');
            $contactMech->CONTACT_MECH_ID = $contactMechId;
            $contactMech->CONTACT_MECH_TYPE_ID = $mechType; // Use the key as the type
            $contactMech->INFO_STRING = $mechValue; // Use the value from the array
            // Save the instance
            $contactMech->save();


            if ($mechType === 'TELECOM_NUMBER') {
                $instance = new TelecomNumber();
                $instance->CONTACT_NUMBER = $request['phonenumber'] ?? null;
                $instance->SECOND_CONTACT_NUMBER = $request['sec_phonenumber'] ?? null;
                $instance->CONTACT_MECH_ID = $contactMechId;
            } elseif ($mechType === 'POSTAL_ADDRESS') {
                $instance = new PostalAddress();
                $instance->ADDRESS1 = $request['address1'] ?? null;
                $instance->ADDRESS2 = $request['address2'] ?? null;
                $instance->CONTACT_MECH_ID = $contactMechId;
            }
            $instance->save();


            // Create and save PartyContactMech instance
            $partyContactMech = new PartyContactMech();
            $partyContactMech->PARTY_ID = $partyId;
            $partyContactMech->CONTACT_MECH_ID = $contactMechId;
            $partyContactMech->FROM_DATE = ''; // from date is set from the model
            $partyContactMech->save();

            // Determine CONTACT_MECH_PURPOSE_TYPE_ID based on CONTACT_MECH_TYPE_ID
            $contactMechPurposeId = '';
            switch ($mechType) {
                case 'POSTAL_ADDRESS':
                    $contactMechPurposeId = 'GENERAL_LOCATION';
                    break;
                case 'TELECOM_NUMBER':
                    $contactMechPurposeId = 'PRIMARY_PHONE';
                    break;
                case 'EMAIL_ADDRESS':
                    $contactMechPurposeId = 'PRIMARY_EMAIL';
                    break;
                default:
                    // Handle other cases if needed
                    break;
            }

            // Create and save PartyContactMechPurpose instance
            $partyContactMechPurpose = new PartyContactMechPurpose();
            $partyContactMechPurpose->PARTY_ID = $partyId;
            $partyContactMechPurpose->CONTACT_MECH_ID = $contactMechId;
            $partyContactMechPurpose->CONTACT_MECH_PURPOSE_TYPE_ID = $contactMechPurposeId;
            $partyContactMechPurpose->FROM_DATE = ''; // from date is set from the model
            $partyContactMechPurpose->save();
        }

        // After saving all contact mechanisms, call upload method
        $this->upload($request, $partyId);
    }

    public function upload(Request $request, $partyId)
    {
        // Handle file upload
        if ($request->hasFile('docs')) {
            foreach ($request->file('docs') as $doc) {
                $dataResource = $this->uploadFile($doc, $partyId); // Pass $partyId
                echo "File uploaded successfully at $dataResource->OBJECT_INFO <br>";
            }
        } else {
            return "No file uploaded";
        }
    }

    private function uploadFile($doc, $partyId)
    {
        $path = $doc->storeAs("public/uploads/$partyId", $doc->getClientOriginalName()); // Store with timestamp and original file name

        // Determine file type
        $fileExtension = $doc->getClientOriginalExtension();
        switch ($fileExtension) {
            case 'jpg':
            case 'jpeg':
            case 'png':
                $dataResourceTypeId = 'IMAGE_OBJECT';
                break;
            case 'pdf':
                $dataResourceTypeId = 'PDF_OBJECT';
                break;
            default:
                $dataResourceTypeId = 'UNKNOWN';
                break;
        }

        // Get MIME type
        $mimeType = $doc->getMimeType();

        // Insert data into data_resource table
        $dataResource = new DataResource();
        $dataResourceId = $this->sequenceService->getNextSequenceValue('DataResource');
        $dataResource->DATA_RESOURCE_ID = $dataResourceId; // Assuming timestamp as ID
        $dataResource->DATA_RESOURCE_NAME = $doc->getClientOriginalName(); // Original file name as name
        $dataResource->OBJECT_INFO = $path; // Full path
        $dataResource->DATA_RESOURCE_TYPE_ID = $dataResourceTypeId; // Set data resource type based on file extension
        $dataResource->MIME_TYPE_ID = $mimeType; // Set MIME type
        $dataResource->save();

        if ($dataResourceTypeId == 'IMAGE_OBJECT') {
            // Insert data into image_data_resource table
            $imageDataResource = new ImageDataResource();
            $imageDataResource->DATA_RESOURCE_ID = $dataResourceId;
            $imageDataResource->IMAGE_DATA = $doc->getClientOriginalName();
            $imageDataResource->save();
        } else {
            // Insert data into pdf_data_resource table
            $pdfDataResource = new PdfDataResource();
            $pdfDataResource->DATA_RESOURCE_ID = $dataResourceId;
            $pdfDataResource->PDF_DATA = $doc->getClientOriginalName();
            $pdfDataResource->save();
        }

        // Insert data into content table
        $content = new Content();
        $contentId = $this->sequenceService->getNextSequenceValue('Content');
        $content->CONTENT_ID = $contentId;
        $content->CONTENT_TYPE_ID = 'DOCUMENT';
        $content->DATA_RESOURCE_ID = $dataResourceId;
        $content->STATUS_ID = 'CTNT_IN_PROGRESS';
        $content->CONTENT_NAME = $doc->getClientOriginalName();
        $content->save();

        $partyContent = new PartyContent();
        $partyContent->CONTENT_ID = $contentId;
        $partyContent->PARTY_ID = $partyId;
        $partyContent->PARTY_CONTENT_TYPE_ID = 'ADHARCARD';
        $partyContent->FROM_DATE = '';
        $partyContent->save();

        return $dataResource;

    }



}












