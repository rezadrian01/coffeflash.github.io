<?php

require('functions.php');

if (isset($_POST['sign-up'])) {
    if (signup($_POST)) {
        echo "<script>
            alert('Berhasil membuat akun');
            document.location.href='login.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal membuat akun');
        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="./src/output.css">
</head>

<body>
    <div class="flex justify-center h-screen">
        <div class="w-full px-4 md:px-0 md:max-w-xl">
            <div class="text-3xl text-center font-semibold my-7">
                Sign up to <span class="bg-gradient-to-br from-[#a1887f] from-15% to-[#3e2723] to-40% text-3xl font-black uppercase bg-clip-text text-transparent">COFFEE</span>
            </div>

            <form action="" method="post">

                <!-- Nomor telepon Input -->
                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                    <label for="phone" class="text-sm text-[#757575]">Mobile phone</label>

                    <input id="phone" type="text" onkeypress="validate(event)" class="text-sm outline-none" placeholder="Mobile phone" name="phone" required>
                </div>

                <!-- Username Input -->
                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                    <label for="username" class="text-sm text-[#757575]">Username</label>

                    <input id="username" type="text" class="text-sm outline-none" placeholder="Username" name="username" required>
                </div>

                <!-- Password Input -->
                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                    <label for="password" class="text-sm text-gray-500">Password</label>

                    <div class="flex justify-between gap-x-2 items-center">
                        <input id="password" type="password" class="password grow text-sm outline-none" placeholder="Password" name="password1" required>

                        <button type="button" onclick="showHidePassword()" class="show_hide_pass p-1 transition hover:bg-[#eeeeee] rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password Input -->
                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400">
                    <label for="confirm_password" class="text-sm text-gray-500">Confirm password</label>

                    <div class="flex justify-between gap-x-2 items-center">
                        <input id="confirm_password" type="password" class="conf_password grow text-sm outline-none" placeholder="Confirm password" name="password2" required>

                        <button type="button" onclick="showHideConfPassword()" class="show_hide_conf_pass p-1 transition hover:bg-[#eeeeee] rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="py-2.5 w-full bg-[#723E29] text-base text-white font-medium rounded-full mt-7" name="sign-up">Sign up</button>
            </form>

            <div class="text-sm text-center mt-4">
                Already have an account? <span><a href="login.php" class="text-[#723E29] hover:underline">Login here</a></span>
            </div>
        </div>
    </div>

    <script>
        // Show and Hide Password Function
        const showHidePassword = () => {
            const passwordElement = document.querySelector(".password");
            const buttonShowHidePass = document.querySelector(".show_hide_pass");

            if (passwordElement.type === "password") {
                passwordElement.type = "text";

                buttonShowHidePass.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>'
            } else {
                passwordElement.type = "password";

                buttonShowHidePass.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>';
            }
        };

        // Confirm Password
        const showHideConfPassword = () => {
            const confirmPasswordElement = document.querySelector(".conf_password");
            const confirmPassButtonShowHidePass = document.querySelector(".show_hide_conf_pass");

            if (confirmPasswordElement.type === "password") {
                confirmPasswordElement.type = "text";

                confirmPassButtonShowHidePass.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>'
            } else {
                confirmPasswordElement.type = "password";

                confirmPassButtonShowHidePass.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>';
            }
        };

        function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>
</body>

</html>