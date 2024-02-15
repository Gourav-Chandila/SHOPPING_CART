// File: public/js/upload.js
// Function to display the selected file name in the custom-file-label in upload document button
function displayFileName(input) {
    // Get the file name from the input element
    var fileName = input.files[0].name;
    // Find the next sibling, which is assumed to be the label for the file input
    var label = input.nextElementSibling;
    // Set the innerHTML of the label to the file name, displaying it to the user
    label.innerHTML = fileName;
}
