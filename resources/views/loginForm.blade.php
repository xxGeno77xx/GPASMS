<div>
  <body>
    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, "San Francisco", Helvetica, Arial, sans-serif;
            font-weight: 300;
            margin: 0;
        }

        $primary: rgb(182, 157, 230);

        html,
        body {
            height: 100vh;
            width: 100vw;
            margin: 0 0;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            background: #f3f2f2;
        }

        h4 {
            font-size: 24px;
            font-weight: 600;
            color: #000;
            opacity: .85;
        }

        label {
            font-size: 12.5px;
            color: #000;
            opacity: .8;
            font-weight: 400;
        }

        form {
            padding: 40px 30px;
            background: #fefefe;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding-bottom: 20px;

            h4 {
                margin-bottom: 20px;
                color: rgba(#000, .5);

                span {
                    color: rgba(#000, 1);
                    font-weight: 700;
                }
            }

            p {
                line-height: 155%;
                margin-bottom: 5px;
                font-size: 14px;
                color: #000;
                opacity: .65;
                font-weight: 400;
                max-width: 200px;
                margin-bottom: 40px;
            }
        }

        a.discrete {
            color: rgba(#000, .4);
            font-size: 14px;
            border-bottom: solid 1px rgba(#000, .0);
            padding-bottom: 4px;
            margin-left: auto;
            font-weight: 300;
            transition: all .3s ease;
            margin-top: 40px;

            &:hover {
                border-bottom: solid 1px rgba(#000, .2);
            }
        }

        button {
            -webkit-appearance: none;
            width: auto;
            min-width: 100px;
            border-radius: 24px;
            text-align: center;
            padding: 15px 40px;
            margin-top: 5px;
            background-color: saturate($primary, 30%);
            color: #fff;
            font-size: 14px;
            margin-left: auto;
            font-weight: 500;
            box-shadow: 0px 2px 6px -1px rgba(0, 0, 0, .13);
            border: none;
            transition: all .3s ease;
            outline: 0;

            &:hover {
                transform: translateY(-3px);
                box-shadow: 0 2px 6px -1px rgba($primary, .65);

                &:active {
                    transform: scale(.99);
                }
            }
        }

        input {
            font-size: 16px;
            padding: 20px 0px;
            height: 56px;
            border: none;
            border-bottom: solid 1px rgba(0, 0, 0, .1);
            background: #fff;
            min-width: 280px;
            box-sizing: border-box;
            transition: all .3s linear;
            color: #000;
            font-weight: 400;
            -webkit-appearance: none;

            &:focus {
                border-bottom: solid 1px $primary;
                outline: 0;
                box-shadow: 0 2px 6px -8px rgba($primary, .45);
            }
        }

        .floating-label {
            position: relative;
            margin-bottom: 10px;

            label {
                position: absolute;
                top: calc(50% - 7px);
                left: 0;
                opacity: 0;
                transition: all .3s ease;
            }

            input:not(:placeholder-shown) {
                padding: 28px 0px 12px 0px;
            }

            input:not(:placeholder-shown)+label {
                transform: translateY(-10px);
                opacity: .7;
            }
        }

        .session {
            display: flex;
            flex-direction: row;
            width: auto;
            height: auto;
            margin: auto auto;
            background: #ffffff;
            border-radius: 4px;
            box-shadow: 0px 2px 6px -1px rgba(0, 0, 0, .12);
        }

        .left {
            width: 220px;
            height: auto;
            min-height: 100%;
            position: relative;
            background-image: url("https://images.pexels.com/photos/114979/pexels-photo-114979.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
            background-size: cover;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;

            svg {
                height: 40px;
                width: auto;
                margin: 20px;
            }
        }
    </style>
    <div class="session">
        <div class="left">
            <?xml version="1.0" encoding="UTF-8"?>
            <svg enable-background="new 0 0 300 302.5" version="1.1" viewBox="0 0 300 302.5" xml:space="preserve"
                xmlns="http://www.w3.org/2000/svg">
                <style type="text/css">
                    .st0 {
                        fill: #fff;
                    }
                </style>
                <path class="st0"
                    d="m126 302.2c-2.3 0.7-5.7 0.2-7.7-1.2l-105-71.6c-2-1.3-3.7-4.4-3.9-6.7l-9.4-126.7c-0.2-2.4 1.1-5.6 2.8-7.2l93.2-86.4c1.7-1.6 5.1-2.6 7.4-2.3l125.6 18.9c2.3 0.4 5.2 2.3 6.4 4.4l63.5 110.1c1.2 2 1.4 5.5 0.6 7.7l-46.4 118.3c-0.9 2.2-3.4 4.6-5.7 5.3l-121.4 37.4zm63.4-102.7c2.3-0.7 4.8-3.1 5.7-5.3l19.9-50.8c0.9-2.2 0.6-5.7-0.6-7.7l-27.3-47.3c-1.2-2-4.1-4-6.4-4.4l-53.9-8c-2.3-0.4-5.7 0.7-7.4 2.3l-40 37.1c-1.7 1.6-3 4.9-2.8 7.2l4.1 54.4c0.2 2.4 1.9 5.4 3.9 6.7l45.1 30.8c2 1.3 5.4 1.9 7.7 1.2l52-16.2z" />
            </svg>
        </div>
        <form action="" class="log-in" autocomplete="off">
            <h4>We are <span>NUVA</span></h4>
            <p>Welcome back! Log in to your account to view today's clients:</p>
            <div class="floating-label">
                <input placeholder="Email" type="text" name="email" id="email" autocomplete="off">
                <label for="email">Email:</label>
            </div>
            <div class="floating-label">
                <input placeholder="Password" type="password" name="password" id="password" autocomplete="off">
                <label for="password">Password:</label>
            </div>
            <button type="submit" onClick="return false;">Log in</button>
            <a href="https://codepen.io/elujambio/pen/YLMVed" class="discrete" target="_blank">Advanced version</a>
        </form>
    </div>
</body>

</div>