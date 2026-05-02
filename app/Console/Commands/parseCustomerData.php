<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

#[Signature('app:parse-customer-data')]
#[Description('Import customer data from CSV file into the database')]
class parseCustomerData extends Command
{
    /**
     * Entry point of the Artisan command.
     *
     * This method is executed when the command is run from the CLI.
     * It triggers the CSV parsing and data import process.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->parseCustomerData();
    }

    /**
     * Parse the CSV file and insert customer records into the database.
     *
     * This method reads the CSV file located in the /data directory,
     * maps each row to the CSV headers, and inserts the data into
     * the `customers` database table.
     *
     * @return void
     */
    private function parseCustomerData(): void
    {
        // Build absolute path to the CSV file
        $file = base_path('data' . DIRECTORY_SEPARATOR . 'customers.csv');

        // Check if the CSV file exists before attempting to read it
        if (!file_exists($file)) {
            $this->error("CSV file not found: {$file}");
            return;
        }

        // Open the CSV file for reading
        $handle = fopen($file, 'r');

        // Read the first row which contains column headers
        $headers = fgetcsv($handle);

        // Counter to track number of imported records
        $count = 0;

        // Iterate through each row of the CSV file
        while (($row = fgetcsv($handle)) !== false) {

            // Combine headers with row values to create associative array
            $data = array_combine($headers, $row);

            // Insert the customer record into the database
            DB::table('customers')->insert([
                'id' => $data['id'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'gender' => $data['gender'],
                'ip_address' => $data['ip_address'],
                'company' => $data['company'],
                'city' => $data['city'],
                'title' => $data['title'],
                'website' => $data['website'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Increment imported records counter
            $count++;
        }

        // Close the file handle after processing
        fclose($handle);

        // Display result in the console
        $this->info("Imported {$count} customers.");
    }
}
