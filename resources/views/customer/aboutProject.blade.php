<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>E Shopper</title>
        <style>
            html, body {        background-color: #fff; font-weight: 100;                height: 100vh;                margin: 0;}
            .full-height {                height: 100vh;            }
            .flex-center {                align-items: center;                display: flex;                justify-content: center;            }
            .position-ref {                position: relative;            }
            .top-right {                position: absolute;                right: 10px;                top: 18px;            }
            .content {                text-align: center;           }
            .title {                font-size: 22px;    color: black;                text-align: center;                font-weight: 300;                letter-spacing: .1rem;                text-decoration: none;            }
            .links > a {                padding: 0 25px;                font-size: 12px;                font-weight: 600;                letter-spacing: .1rem;                text-decoration: none;                text-transform: uppercase;            }
            .m-b-md {                margin-bottom: 30px;            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title" style="margin: 10%" >
                    <h1>Description</h1>
                    <br>
                    An online store that allows its owner to display sections and products through the dashboard to show me users
                    It allows users to locate products, add them in the shopping cart, and create an order
                    It also allows the user to pay online or pay on delivery
                    The order goes to the admin and adds it to the delivery, and the delivery receives it through its dashboard.
                    More about products
                    <br>
                    <br>
                    متجر الكتروني يتيح لصاحبه عرض الاقسام ومنتجاته من خلال الداشبورد ليظهر لي المستخدمين
                    حيث يتيح للمستخدمين رؤيه المنتجات واضافتها في عربه التسوق وانشاء اوردر
                    كما يتيح للمستخدم الدفع اونلاين او الدفع عند الاستلام
                    يذهب الاوردر للادمن ويقوم اضافته للدليفري ويستلمه الدليفري من خلال الداش بورد الخاصه به
                    <br><br><br>
                    <div class="links">
                        <a href="{{ route('index') }}">Home Page</a>
                        <a href="{{ route('admin') }}">Admin Panel</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
