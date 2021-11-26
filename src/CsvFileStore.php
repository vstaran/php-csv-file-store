<?php

/**
 *
 * = First Iteration
 * rewind();
 * valid();
 * current();
 * key();
 *
 * = Remaining Iterations until valid() returns false
 * next();
 * valid();
 * current();
 * key();
 *
 */

namespace Vstaran;

use Iterator;

/**
 * Class CsvFileStore
 */
class CsvFileStore implements Iterator
{
    protected $file;
    protected $index_line;
    protected $current_line = null;
    protected $has_column_name;
    protected $columns;

    /**
     * CsvFileStore constructor.
     *
     * @param string    $filename           File name
     * @param bool      $has_column_name    First row of file is columns' names
     * @throws Exception
     */
    public function __construct($filename, $has_column_name = true)
    {
        if(file_exists($filename)) {
            $this->file = fopen($filename, 'r');
            $this->has_column_name = $has_column_name;
        } else {
            throw new \Exception('File don\'t exists.');
        }
    }

//    /* Example how to use Generator with yield */
//    public function generator()
//    {
//        while ($values = fgetcsv($this->file)) {
//            $result = array_combine($this->keys, $values);
//            yield $result;
//        }
//    }

    public function current()
    {
        return $this->current_line;
    }

    public function next()
    {
        $this->fetchLine();
        $this->index_line++;
    }

    public function key()
    {
        return $this->index_line;
    }

    public function valid()
    {
        return !feof($this->file) || !is_null($this->current_line);
    }

    public function rewind()
    {
        rewind($this->file);
        $this->columns = ($this->has_column_name)? fgetcsv($this->file):[];

        $this->index_line = 0;
        $this->fetchLine();
    }

    /**
     * Get line from file
     */
    public function fetchLine()
    {
        $values = fgetcsv($this->file);
        if(is_array($values)) {
            $this->current_line = ($this->has_column_name)? array_combine($this->columns, $values) : $values;
        } else {
            // if line from file is empty
            $this->current_line = null;
        }
    }
}