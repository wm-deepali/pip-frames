<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\PostalCode;

class ImportEuropePostalCodes extends Command
{
    protected $signature = 'import:eu-postal-codes';
    protected $description = 'Import postal codes for Europe and Ireland from GeoNames dataset';

    public function handle()
    {
        $countryCodeMap = [
            'IE' => 'Ireland',
            'FR' => 'France',
            'DE' => 'Germany',
            'NL' => 'Netherlands',
            'IT' => 'Italy',
            // Add more as needed
        ];

        $files = glob(storage_path('app/postal-data/*.txt'));

        foreach ($files as $filePath) {
            $this->info("Processing: $filePath");

            $handle = fopen($filePath, "r");

            while (($line = fgetcsv($handle, 1000, "\t")) !== false) {
                if (count($line) < 10)
                    continue;

                list($countryCode, $pincode, $city, $state, $county) = [
                    $line[0],
                    $line[1],
                    $line[2],
                    $line[3],
                    $line[4]
                ];

                // Convert IE → Ireland
                $country = $countryCodeMap[$countryCode] ?? $countryCode;

                \App\Models\PostalCode::updateOrCreate(
                    ['pincode' => $pincode, 'country' => $country],
                    [
                        'city' => $city,
                        'state' => $state,
                        'continent' => 'Europe',
                        'delivery_charge' => 0,
                        'is_serviceable' => true,
                    ]
                );
            }

            fclose($handle);
        }


    }
}
