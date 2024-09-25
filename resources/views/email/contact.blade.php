
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data->subject }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            max-width: 100%;
            height: auto;
        }
        .content {
            margin: 20px 0;
        }
        .content p {
            font-size: 15px;
            line-height: 1.6;
        }
        .content h2 {
            font-size: 24px;
            margin-top: 0;
        }
        .footer {
            text-align: right;
            margin-top: 40px;
        }
        .footer h3 {
            font-size: 15px;
            color: #333;
        }
        .footer p {
            font-size: 14px;
            color: #777;
            margin: 0;
        }
        .content h3.greet {
            font-size: 15px;
            margin-top: 20px;
            text-align: left;
            font-weight: normal;
        }
        .content p.date {
            text-align: right;
        }
        .content p.detail {
            font-size: 16px;
            line-height: 1.6;
            margin-left: 40px;
            font-weight: normal; /* Changed from 100px to normal */
        }
        .bold-text {
            font-weight: bold;
            font-size: 15px;
        }
    </style>
</head>

<body>
   
    <div class="container">
    <img src="http://test.24expo.net/images/logos/logo-v3.png" alt="" style="max-width: 100%;
            height: auto;
            margin: 0 auto; /* Center the image */
            display: block;">
        <div class="content">
            <p class="date">{{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
            <h3 style="text-align: center"><span class="bold-text">メッセージを受信しました!</span></h3>

            <!-- Greeting Section -->
            <p class="detail "><span class="bold-text">こんにちは、</span></p> <!-- Set the greeting message -->
            <p class="detail"><span class="bold-text">{{ $data -> emailcontent }}</span></p>

            <p class="detail">＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝</p>
            
            <!-- Detail Section -->
            <p class="detail"><strong>名前：</strong> {{ $data->name }}</p>
            <p class="detail"><strong>名前(フリガナ)：</strong> {{ $data->furiname }}</p>
            <p class="detail"><strong>メールアドレス：</strong> {{ $data->email }}</p>
            <p class="detail"><strong>お問い合わせ内容：</strong> {{ $data->content }}</p>
           
            <p class="detail">＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝</p>
        </div>
        <div class="footer">
            <p style="text-align: right;">{{ $senderName }}<br>{{ $senderEmail }}</p>
        </div>
    </div>
</body>
</html>





