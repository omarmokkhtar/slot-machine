
# Slot Machine

By Omar Mokhtar

A simple slot machine.

## Tech Stack

- PHP(Lumen)


## Features

- A simple slot machine command line tool made with Lumen, all you need to do is to run

```
php artisan slot:run
```


## Project Description

- Made a service layer where all the logic is, there is 2 methods one to generate the random board sequence and the second method is to check for any similarities and returns the result.
- Then there is the new command line file, where I call the slot service to return the data.
