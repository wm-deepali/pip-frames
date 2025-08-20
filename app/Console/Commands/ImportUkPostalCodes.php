<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostalCode;
use League\Csv\Reader;

class ImportUkPostalCodes extends Command
{

    protected $signature = 'import:uk-postal-codes {--file= : Path to the CSV file}';
    protected $description = 'Import UK postal code data into the database';

    public function handle()
    {
        $file = $this->option('file') ?? storage_path('app/ir_postcodes.csv');

        if (!file_exists($file)) {
            $this->error("File not found: $file");
            return 1;
        }

        $csv = Reader::createFromPath($file, 'r');
        $csv->setDelimiter(';'); // FIX: Set the correct delimiter
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();
        $count = 0;
// dd($records);
      foreach ($records as $record) {
    $this->line("Importing: " . json_encode($record));

    PostalCode::updateOrCreate(
        ['pincode' => $record['postcode']],
        [
            'country' => $record['country'] ?? null,
            'state' => $record['region2'] ?? $record['region1'] ?? null,
            'city' => $record['locality'] ?? null,
            'delivery_charge' => 0,
            'is_serviceable' => true,
        ]
    );
    $count++;
}

        $this->info("✅ Imported $count postal codes.");
        return 0;
    }
}
