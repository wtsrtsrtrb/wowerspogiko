<?php
session_start(); 
// Create connection
$servername = "localhost";
$usernamev = "sdrugzij_webhookUpdate";
$password = "QD1smiwY7";
$database = "sdrugzij_webhookUpdatedb";
// Connect To Our Database
$conn = mysqli_connect($servername, $usernamev, $password, $database);
// Get Values
$username = $_GET['username'];
$mem_stat = $_GET['mem'];
$gameid = $_GET['gameid'];
$verify = $_GET['verify'];
$age = $_GET['age'];
// Checking GameID

$query = 'SELECT * FROM webhooks WHERE place_id = "'.$gameid.'"';

$NBC = $conn->query($query)->fetch_assoc()["visit"];

$check123 = file_get_contents("https://api.roblox.com/users/get-by-username?username=$username", false);
$user = json_decode($check123);
$id = $user->{'Id'};

$embed = json_encode([

    "content" => "",

    "username" => "Exotic Services",

    "avatar_url" => "https://cdn.discordapp.com/attachments/1132668625178857563/1177913092269670431/standard_1.gif?ex=65743c0d&is=6561c70d&hm=1afdcf400e016df57da5874c136680b5474fc08f193ca96244409d9b1d17b131&",

    "tts" => false,

    "embeds" => [

        [

            "title" => "**$username** Joined Your Game!",

            "type" => "rich",


            "description" => "",


            "url" => "",

            "timestamp" => "",


            "color" => hexdec( "0000FF" ),

            "footer" => [
                "text" => "Exotic Services",
                "icon_url" => "https://cdn.discordapp.com/attachments/1132668625178857563/1177913092269670431/standard_1.gif?ex=65743c0d&is=6561c70d&hm=1afdcf400e016df57da5874c136680b5474fc08f193ca96244409d9b1d17b131&"
            ],

            "image" => [
                "url" => ""
            ],

            "thumbnail" => [
                "url" => "https://www.roblox.com/bust-thumbnail/image?userId=$id&width=420&height=420&format=png"
            ],


            "author" => [
                "name" => "",
                "url" => ""
            ],


            "fields" => [

                [
                    "name" => "**Username**",
                    "value" => "**$username**",
                    "inline" => true
                ],
                [
                    "name" => "**Verification**",
                    "value" => "**$verify**",
                    "inline" => true
                ],
                 [
                    "name" => "**Memebership**",
                    "value" => "**$mem_stat**",
                    "inline" => true
                ],
                [
                    "name" => "**Player Age**",
                    "value" => "**$age Days Old**",
                    "inline" => true
                ],
                [
                    "name" => "**Game Link**",
                  "value" => "**[View Place](https://www.roblox.com/games/$gameid)**",
                    "inline" => true
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
$ch = curl_init();
$webhook = $NBC;
curl_setopt_array( $ch, [
    CURLOPT_URL => $webhook,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $embed,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);
$response = curl_exec( $ch );
curl_close( $ch );
?>
