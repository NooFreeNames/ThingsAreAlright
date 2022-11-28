<?php
const HOSTNAME = 'localhost';
const USERNAME = 'root'; //shjnynct
const PASSWORD = ''; //J61J9E
const DATABASE = 'shjnynct_m4';
const PORT = 3307;

$conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE, PORT);
$conn->set_charset('utf8');
