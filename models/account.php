<?php
    class Account {
        public $id;
        public $name;
        public $email;
        public $address;

        function __construct($id, $name, $email, $address) {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->address = $address;
        }

        static function get_samples() {
            return [
                new Account(1, "John Doe", "john.doe@gmail.com", "1234 Street, City, Country H6Y A2Z")
            ];
        }
    }
?>