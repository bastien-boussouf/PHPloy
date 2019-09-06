<?php

use Banago\PHPloy\PHPloy;

class ComposerVersionTest extends PHPUnit_Framework_TestCase {

    private function readJsonVersion($fileName, $key = 'version')
    {
        $this->assertFileExists($fileName);
        $data = json_decode(file_get_contents($fileName));
        return isset($data->$key) ? $data->$key : null;
    }

    public function testVersionMatches()
    {
        if (!function_exists('json_decode')) {
            $this->markTestIncomplete('Missing ext-json');
        }
        $composerVersion = $this->readJsonVersion(__DIR__ . '/../composer.json');
        $this->assertNotEmpty($composerVersion, 'composer.json version must not be empty');

        $version = PHPloy::VERSION;
        $this->assertNotEmpty($version, 'embedded checkin version must not be empty');
        $this->assertEquals($composerVersion, $version, 'composer.json and phploy version must match');
    }
}
