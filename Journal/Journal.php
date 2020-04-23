<?php
/**
 * @package Journal
 * 
 * @author Sergey Iontsev
 * @version 1.0
 * @copyright © 2017 Sergey Iontsev. All rights reserved.
 * @license MIT License. See LICENSE file for details.
 */

namespace Journal;

/**
 * Journal class
 * 
 * @package Journal
 */
class Journal
{
    private $context;
    private $content = [];

    /**
     * Constructor
     * 
     * @param string $caption
     * @return null
     */
    public function __construct(string $caption)
    {
        $this->context = $caption;
    }

    /**
     * Destructor
     * 
     * @return null
     */
    public function __destruct()
    {
        foreach ($this->content as $content) {
            fclose($content);
        }
    }

    /**
     * Create
     * 
     * Create a file stream and add to the list for the content writing.
     * @param string $address
     * @param string $journal optional
     * @return self
     */
    public function create(string $address, string $journal = null)
    {
        $journal = (isset($journal) === true) ? $journal : $address;

        if ($this->content[$journal] === false) {
            $this->content[$journal] = fopen($address, "a");
            if ($this->content[$journal] === false) {
                throw new \Exception("Could not open file \"{$address}\"!");
            }
        } else {

        }

        return $this;
    }

    /**
     * Update
     * 
     * Write a message in all file streams in the list.
     * @param string $message
     * @param string $message,... optional
     * @return self
     */
    public function update(string ...$message)
    {
        foreach ($message as $message) {
            $message = date("Y-m-d G:i:s", strtotime("now")) . " | [{$this->context}] {$message}\r\n";

            foreach ($this->content as $journal => $content) {
                if (fwrite($content, $message) === false) {
                    throw new \Exception("Could not write data to file \"{$journal}\"!");
                }
            }
        }

        return $this;
    }

    /**
     * Delete
     * 
     * Delete the file stream from the list.
     * @param string $journal
     * @return self
     */
    public function delete(string $journal)
    {
        fclose($this->content[$journal]);
        unset($this->content[$journal]);
    }
}
