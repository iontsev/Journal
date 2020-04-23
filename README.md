# Journal
The Journal is the simple PHP class for logging.

## Ability
### Constructor

    __construct( string $caption )

* $caption — the section name, will be used as tag for all messages.

### Create
Create a file stream and add to the list for the content writing.

    self journal->create( string $address [, string $journal] )

* $address — the file path for write of the content.
* $journal — the alias for file stream (the default is the file path for write).

### Update
Write a message in all file streams in the list.

    self journal->update( string ...$message )

* $message — the option required value or not. Only true and false are allowed.

### Delete
Delete the file stream from the list.

    self journal->delete( string $journal )

* $journal — the alias for file stream.

## Example
Create a journal object:

    $journal = new journal('Script for test');

Create file streams:

    $journal->create('path/to/journal/file-1.csv', 'file-1.csv');
    $journal->create('path/to/journal/file-2.csv', 'file-2.csv');
    $journal->create('path/to/journal/file-3.csv');

Write in file streams:

    $journal->update('This test is success.');
    $journal->update('This message #1.', 'This message #2.', 'This message #3.');

Delete file streams:

    $journal->delete('file-2.csv');
    $journal->delete('path/to/journal/file-3.csv');
