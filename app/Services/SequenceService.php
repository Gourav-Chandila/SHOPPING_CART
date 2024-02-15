<?php
namespace App\Services;
use App\Models\SequenceValueItem;
use Illuminate\Support\Facades\DB;

class SequenceService
{
    /**
     * Get the next sequence value for the given sequence name.
     *
     * @param string $seqName The name of the sequence
     * @return int|null The next sequence value or null if the sequence doesn't exist or cannot be retrieved
     */
    public function getNextSequenceValue($seqName)
    {
        // Begin a transaction
        DB::beginTransaction();

        // Lock the sequence row for update
        $sequence = SequenceValueItem::lockForUpdate()->where('SEQ_NAME', $seqName)->first();

        // Check if the sequence exists
        if ($sequence) {
            $currentSeqValue = $sequence->SEQ_ID;

            // If the current sequence value exists
            if ($currentSeqValue) {
                // Increment the sequence value
                DB::table('sequence_value_item')->where('SEQ_NAME', $seqName)->increment('SEQ_ID');

                // Commit the transaction
                DB::commit();
                return $currentSeqValue;
            } else {
                // Roll back the transaction if the current sequence value is null
                DB::rollBack();
                return null;
            }
        } else {
            // Roll back the transaction if the sequence doesn't exist
            DB::rollBack();
            return null;
        }
    }
}
