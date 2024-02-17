<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            background-color: #fff;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }



        .rtl {
            text-align: right;
        }

        .welcome-desc img {
            width: 100%;
        }


    </style>

</head>

<body>
    <div class="invoice-box" style="margin-left: auto; margin-right: auto; display: block;">

        <div style="margin-top: 20px; margin-bottom: 20px;">
            <div style="text-align: center;">
                <img src="https://sinrachasit.com/images/logo.png" style="width:50%; max-width:80px;">
            </div>
            <div>
                <h3>ระบบแจ้งการลงทะเบียนจองห้องประชุม</h3>
            </div>

            <div class="welcome-desc" style="border:5px">
                <p>ขอบคุณสำหรับการใช้งาน</p>
                <p>เราจะติดต่อกลับภายใน 7 วันทำการ เพื่อยืนยันการจองห้องประชุม</p>

                <br>
                <p>ติดตามสถานะได้ที่  : {{ config('app.domain') }}booking/tacking?token={{ $token }}</p>
            </div>
        </div>
        <hr>

        <div style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
            <span><u>รายละเอียดเพิ่มเติม</u></span>
            <table>
                <tr>
                    <td>
                        <a class="social-link" href="https://www.facebook.com/tijthailand.org/" target="_blank" title="Facebook" style="color: #ecba78; text-decoration: none !important; text-underline: none; font-size: 14px; text-align: center;">
                            <img width="32" class="social-icons" alt="Facebook" src="https://orderlyemails.com/facebook_3.png" style="width: 32px; height: auto !important; vertical-align: middle; text-align: center; padding: 6px 6px 0 0px;">
                          </a>
                          <a class="social-link" href="https://twitter.com/tijthailand" target="_blank" title="Twitter" style="color: #ecba78; text-decoration: none !important; text-underline: none; font-size: 14px; text-align: center;">
                            <img width="32" class="social-icons" alt="Twitter" src="https://orderlyemails.com/twitter_3.png" style="width: 32px; height: auto !important; vertical-align: middle; text-align: center; padding: 6px 6px 0;">
                          </a>

                          <a class="social-link" href="https://www.youtube.com/user/TIJThailand" target="_blank" title="YouTube" style="color: #ecba78; text-decoration: none !important; text-underline: none; font-size: 14px; text-align: center;">
                            <img width="32" class="social-icons" alt="YouTube" src="https://orderlyemails.com/youtube_3.png" style="width: 32px; height: auto !important; vertical-align: middle; text-align: center; padding: 6px 0px 0 6px;">
                          </a>

                          <p>
                            999 สถาบันเพื่อการยุติธรรมแห่งประเทศไทย<br style="text-align: center;">
                            ถนนแจ้งวัฒนะ แขวงทุ่งสองห้อง เขตหลักสี่<br style="text-align: center;">
                            กรุงเทพฯ 10210 <br style="text-align: center;">
                            <br style="text-align: center;">
                            สถาบันเพื่อการยุติธรรมแห่งประเทศไทย (องค์การมหาชน)
                          </p>
                    </td>
                </tr>
            </table>
        </div>

    </div>

</body>

</html>
