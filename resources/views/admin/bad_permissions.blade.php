<!DOCTYPE html>
<html>
    <head>
        <title>Bad Permissions</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
				.subtitle {
                font-size: 38px;
                margin-bottom: 40px;
            }
				.button{
					padding:15px;
					border:1px solid #B0BEC5;
					background: transparent;
					color:#B0BEC5;
					font-family: 'Lato', sans-serif;
					font-size:15px;
					cursor:pointer;
					width:150px;
					border-radius:50px;
					text-align: center;
				}
        </style>
    </head>
	 <body>
        <div class="container">
            <div class="content">
                <div class="title">Bad Permissions</div>
					 <div class="subtitle">You don't have access to this route.</div>
					 <button type="button" onClick="javascript:history.back()" class="button">Back</button>
            </div>
        </div>
    </body>
</html>
