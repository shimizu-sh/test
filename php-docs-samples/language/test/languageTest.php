<?php
/**
 * Copyright 2017 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Cloud\Samples\Language\Tests;

use Google\Cloud\TestUtils\TestTrait;
use Google\Cloud\TestUtils\ExecuteCommandTrait;

/**
 * Unit Tests for language commands.
 */
class languageTest extends \PHPUnit_Framework_TestCase
{
    use TestTrait;
    use ExecuteCommandTrait;

    private static $commandFile = __DIR__ . '/../language.php';

    public function gcsFile()
    {
        return sprintf(
            'gs://%s/language/presidents.txt',
            $this->requireEnv('GOOGLE_STORAGE_BUCKET')
        );
    }

    public function testAll()
    {
        $output = $this->runCommand('all', [
            'content' => 'Barack Obama lives in Washington D.C.'
        ]);
        $this->assertContains('Name: Barack Obama', $output);
        $this->assertContains('Type: PERSON', $output);
        $this->assertContains('Salience:', $output);
        $this->assertContains('Wikipedia URL: https://en.wikipedia.org/wiki/Barack_Obama', $output);
        $this->assertContains('Knowledge Graph MID:', $output);
        $this->assertContains('Name: Washington D.C.', $output);
        $this->assertContains('Document Sentiment:', $output);
        $this->assertContains('Magnitude:', $output);
        $this->assertContains('Score:', $output);
        $this->assertContains('Sentence: Barack Obama lives in Washington D.C.', $output);
        $this->assertContains('Sentence Sentiment:', $output);
        $this->assertContains('  Magnitude:', $output);
        $this->assertContains('  Score:', $output);
        $this->assertContains('Token text: Barack', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
        $this->assertContains('Token text: Obama', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
        $this->assertContains('Token text: lives', $output);
        $this->assertContains('Token part of speech: VERB', $output);
        $this->assertContains('Token text: in', $output);
        $this->assertContains('Token part of speech: ADP', $output);
        $this->assertContains('Token text: Washington', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
        $this->assertContains('Token text: D.C.', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
    }

    public function testAllFromStorageObject()
    {
        $output = $this->runCommand('all', [
            'content' => $this->gcsFile()
        ]);
        $this->assertContains('Name: Barack Obama', $output);
        $this->assertContains('Type: PERSON', $output);
        $this->assertContains('Salience:', $output);
        $this->assertContains('Wikipedia URL: https://en.wikipedia.org/wiki/Barack_Obama', $output);
        $this->assertContains('Knowledge Graph MID:', $output);
        $this->assertContains('Name: Washington D.C.', $output);
        $this->assertContains('Document Sentiment:', $output);
        $this->assertContains('Magnitude:', $output);
        $this->assertContains('Score:', $output);
        $this->assertContains('Sentence: Barack Obama lives in Washington D.C.', $output);
        $this->assertContains('Sentence Sentiment:', $output);
        $this->assertContains('  Magnitude:', $output);
        $this->assertContains('  Score:', $output);
        $this->assertContains('Token text: Barack', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
        $this->assertContains('Token text: Obama', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
        $this->assertContains('Token text: lives', $output);
        $this->assertContains('Token part of speech: VERB', $output);
        $this->assertContains('Token text: in', $output);
        $this->assertContains('Token part of speech: ADP', $output);
        $this->assertContains('Token text: Washington', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
        $this->assertContains('Token text: D.C.', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
    }

    public function testEntities()
    {
        $output = $this->runCommand('entities', [
            'content' => 'Barack Obama lives in Washington D.C.'
        ]);
        $this->assertContains('Name: Barack Obama', $output);
        $this->assertContains('Type: PERSON', $output);
        $this->assertContains('Salience:', $output);
        $this->assertContains('Wikipedia URL: https://en.wikipedia.org/wiki/Barack_Obama', $output);
        $this->assertContains('Knowledge Graph MID:', $output);
        $this->assertContains('Name: Washington D.C.', $output);
    }


    public function testEntitiesFromStorageObject()
    {
        $output = $this->runCommand('entities', [
            'content' => $this->gcsFile()
        ]);
        $this->assertContains('Name: Barack Obama', $output);
        $this->assertContains('Type: PERSON', $output);
        $this->assertContains('Salience:', $output);
        $this->assertContains('Wikipedia URL: https://en.wikipedia.org/wiki/Barack_Obama', $output);
        $this->assertContains('Knowledge Graph MID:', $output);
        $this->assertContains('Name: Washington D.C.', $output);
    }

    public function testSentiment()
    {
        $output = $this->runCommand('sentiment', [
            'content' => 'Barack Obama lives in Washington D.C.'
        ]);
        $this->assertContains('Document Sentiment:', $output);
        $this->assertContains('Magnitude:', $output);
        $this->assertContains('Score:', $output);
        $this->assertContains('Sentence: Barack Obama lives in Washington D.C.', $output);
        $this->assertContains('Sentence Sentiment:', $output);
        $this->assertContains('  Magnitude:', $output);
        $this->assertContains('  Score:', $output);
    }


    public function testSentimentFromStorageObject()
    {
        $output = $this->runCommand('sentiment', [
            'content' => $this->gcsFile()
        ]);
        $this->assertContains('Document Sentiment:', $output);
        $this->assertContains('Magnitude:', $output);
        $this->assertContains('Score:', $output);
        $this->assertContains('Sentence: Barack Obama lives in Washington D.C.', $output);
        $this->assertContains('Sentence Sentiment:', $output);
        $this->assertContains('  Magnitude:', $output);
        $this->assertContains('  Score:', $output);
    }

    public function testSyntax()
    {
        $output = $this->runCommand('syntax', [
            'content' => 'Barack Obama lives in Washington D.C.'
        ]);
        $this->assertContains('Token text: Barack', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
        $this->assertContains('Token text: Obama', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
        $this->assertContains('Token text: lives', $output);
        $this->assertContains('Token part of speech: VERB', $output);
        $this->assertContains('Token text: in', $output);
        $this->assertContains('Token part of speech: ADP', $output);
        $this->assertContains('Token text: Washington', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
        $this->assertContains('Token text: D.C.', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
    }

    public function testSyntaxFromStorageObject()
    {
        $output = $this->runCommand('syntax', [
            'content' => $this->gcsFile()
        ]);
        $this->assertContains('Token text: Barack', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
        $this->assertContains('Token text: Obama', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
        $this->assertContains('Token text: lives', $output);
        $this->assertContains('Token part of speech: VERB', $output);
        $this->assertContains('Token text: in', $output);
        $this->assertContains('Token part of speech: ADP', $output);
        $this->assertContains('Token text: Washington', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
        $this->assertContains('Token text: D.C.', $output);
        $this->assertContains('Token part of speech: NOUN', $output);
    }

    public function testEntitySentiment()
    {
        $output = $this->runCommand('entity-sentiment', [
            'content' => 'Barack Obama lives in Washington D.C.'
        ]);
        $this->assertContains('Entity Name: Barack Obama', $output);
        $this->assertContains('Entity Type: PERSON', $output);
        $this->assertContains('Entity Salience:', $output);
        $this->assertContains('Entity Magnitude:', $output);
        $this->assertContains('Entity Score:', $output);
        $this->assertContains('Entity Name: Washington D.C.', $output);
        $this->assertContains('Entity Type: LOCATION', $output);
    }

    public function testEntitySentimentFromStorageObject()
    {
        $output = $this->runCommand('entity-sentiment', [
            'content' => $this->gcsFile()
        ]);
        $this->assertContains('Entity Name: Barack Obama', $output);
        $this->assertContains('Entity Type: PERSON', $output);
        $this->assertContains('Entity Salience:', $output);
        $this->assertContains('Entity Magnitude:', $output);
        $this->assertContains('Entity Score:', $output);
        $this->assertContains('Entity Name: Washington D.C.', $output);
        $this->assertContains('Entity Type: LOCATION', $output);
    }

    public function testClassifyText()
    {
        $output = $this->runCommand('classify', [
            'content' => 'The first two gubernatorial elections since President '
                . 'Donald Trump took office went in favor of Democratic '
                . 'candidates in Virginia and New Jersey.'
        ]);
        $this->assertContains('Category Name: /News/Politics', $output);
        $this->assertContains('Confidence:', $output);
    }

    public function testClassifyTextFromStorageObject()
    {
        $output = $this->runCommand('classify', [
            'content' => $this->gcsFile()
        ]);
        $this->assertContains('Category Name: /News/Politics', $output);
        $this->assertContains('Confidence:', $output);
    }
}
