<?php
    session_start();

    require('functions.php');

    $phone = $_SESSION['data']['phone'];
    $result = mysqli_query($conn,"SELECT * FROM user WHERE phone = '$phone';");
    while($row = mysqli_fetch_assoc($result)){
        $data = $row;
    }
    //cek apakah user sudah login
    if(!isset($_SESSION['data'])){
      header("Location: index.php");
      exit();
    }

    //jika user tekan cancel
    if(isset($_POST['cancelEdit'])){
      header("Location: profile.php");
      exit();
    }

    //jika user tekan tombol edit
    if(isset($_POST['fixEdit'])){
        $username = $_POST['username'];
        $alamat = $_POST['alamat'];
        $newPassword = $_POST['newPassword'];
        $oldPassword = $_POST['oldPassword'];

        // Get user's password
        $getUser = mysqli_query($conn, "SELECT password FROM user WHERE phone = '{$_SESSION['data']['phone']}';");
        $userData = mysqli_fetch_assoc($getUser);

        if ($newPassword === "" && $oldPassword !== "") {
            echo "<script>
                    alert('Masukkan password baru anda.');
                </script>";
        } elseif ($newPassword !== "" && $oldPassword === "") {
            echo "<script>
                    alert('Masukkan password lama anda.');
                </script>";
        } elseif ($newPassword !== "" && $oldPassword !== "") {
            if (password_verify($oldPassword, $userData['password'])) {
                $new_password = password_hash($newPassword, PASSWORD_DEFAULT);

                $updateProfile = mysqli_query($conn, "UPDATE user SET username = '$username', password = '$new_password', alamat = '$alamat' WHERE phone = '{$_SESSION['data']['phone']}';");

                if ($updateProfile) {
                    header("Location: profile.php?message=update_berhasil");
                    exit();
                } else {
                    header("Location: profile-edit.php?message=update_gagal");
                }
            } else {
                echo "<script>
                    alert('Password lama anda salah.');
                </script>";
            }
        } else {
            $updateProfile = mysqli_query($conn, "UPDATE user SET username = '$username', alamat = '$alamat' WHERE phone = '{$_SESSION['data']['phone']}';");

            if ($updateProfile) {
                header("Location: profile.php?message=update_berhasil");
                exit();
            } else {
                header("Location: profile-edit.php?message=update_gagal");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="./src/output.css">
</head>
<body>
    <header class="py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16">
        <div class="flex justify-between items-center">
            <h5 class="bg-gradient-to-br from-[#a1887f] from-15% to-[#3e2723] to-40% text-3xl font-black uppercase bg-clip-text text-transparent">COFFEE</h5>
            <!-- jika belum login maka tombolnya login/signup -->
            <?php if (!isset($_SESSION["data"])) : ?>
                <a href="login.php" class="py-3 px-6 bg-[#723E29] text-sm text-white font-medium rounded-full">Log in / Sign up</a>
            <!-- jika sudah login maka tombol menjadi logout -->
            <?php else : ?>
                <div id="parent-dropdown" class="relative inline-block">
                    <button onclick="menuDropdown()" class="flex items-center py-3 pl-6 pr-5 border rounded-full font-medium text-sm">
                        Welcome, <span class="font-normal"><?php echo $_SESSION['data']['username']; ?></span>
                    
                        <span class="ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </button>

                    <div id="menu-dropdown" class="hidden absolute top-auto right-0 w-52">
                        <ul class="mt-2 p-1 bg-white shadow-md rounded-xl border">
                            <?php
                                if($_SESSION['data']['role'] === "admin") {
                            ?>
                                <li>
                                    <button class="py-2 pl-3.5 w-full hover:bg-[#eeeeee] text-left rounded-lg">
                                        Dashboard
                                    </button>
                                </li>
                                
                            <?php }; ?>
                            <li>
                                <button class="py-2 pl-3.5 w-full hover:bg-[#eeeeee] text-left rounded-lg">
                                    Profile
                                </button>
                            </li>
                            
                            <li>
                                <div class="w-full">
                                    <a href="logout.php">
                                        <button class="py-2 pl-3.5 w-full hover:bg-[#eeeeee] text-left rounded-lg">
                                            Logout
                                        </button>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <a href="logout.php" class="py-3 px-6 bg-[#723E29] text-sm text-white font-medium rounded-full">Logout</a> -->
            <?php endif; ?>
        </div>
    </header>

    <main class="grow py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16">
        <div class="w-3/4 mx-auto">
            <form action="" method="POST">
                <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
                    <dl class="-my-3 divide-y divide-gray-100 text-sm">
                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Phone Number</dt>
                            <dd class="text-gray-700 sm:col-span-2"><?= $data['phone']; ?></dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Username</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                <input type="text" id="phone" name="username" value="<?= $data['username']; ?>" required>
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Address</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                <input type="text" id="phone" name="alamat" value="<?= $data['alamat']; ?>" required>
                            </dd>
                        </div>
                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">New password</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                <input type="password" id="phone" name="newPassword">
                            </dd>
                        </div>
                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Your password</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                <input type="password" id="phone" name="oldPassword">
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="my-4">
                    <button class="hover:bg-slate-100 p-3 rounded-xl" type="submit" name="fixEdit">Edit</button>

                    <a href="profile.php" class="hover:bg-slate-100 p-3 rounded-xl">Cancel</a>
                </div>
            </form>
        </div>
    </main>

    <footer class="py-3 px-12 border-t bg-[#723E29] text-white text-center">
            Copyright &#169;<span id="year"></span>
    </footer>
    <script src="script.js" ></script>
</body>
</html>