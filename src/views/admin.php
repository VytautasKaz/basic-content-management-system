<?php

use Model\NavLink;

require_once "./bootstrap.php";

$roodDir = '/cms';

// Login

session_start();
if (
    isset($_POST['login'])
    && !empty($_POST['username'])
    && !empty($_POST['password'])
) {
    if (
        $_POST['username'] === 'admin' &&
        $_POST['password'] === 'adminpw'
    ) {
        $_SESSION['logged_in'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $_POST['username'];
    } else {
        print('<script type="text/javascript">alert("Wrong username or password.");</script>');
    }
}

// Logout

if (isset($_GET['action']) == 'logout') {
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['logged_in']);
    session_destroy();
    print('<script type="text/javascript">alert("You have been logged out successfully.");</script>');
    header('Location:' . $roodDir . '/admin');
}

// Delete page logic

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $update = $entityManager->find('Model\NavLink', $id);
    $entityManager->remove($update);
    $entityManager->flush();
    header('Location:' . $roodDir . '/admin');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS - Admin page</title>
    <link rel="stylesheet" href="./src/css/default.css">
    <link rel="stylesheet" href="./src/css/admin.css">
</head>

<body>
    <div class="container">
        <?php

        if (!$_SESSION['logged_in']) {
            print('<div align="center"><h4>Enter your login information</h4>
                   <form class="login-form" action="" method="post">
                        <input type="text" name="username" placeholder="username = admin" required><br>
                        <input type="password" name="password" placeholder="password = adminpw" required><br>
                        <button class="login-btn" type="submit" name="login">Login</button>
                   </form></div>');
        } else {
            print('<header><nav>
                <ul>
                    <li><a href="./admin">Admin</a></li>
                    <li><a href="./">View Page</a></li>
                    <li><a href=?action=logout>Logout</a></li>
                </ul>
            </nav></header>');
            print('<table>
            <tr>
                <th>Page</th>
                <th>Actions</th>
            </tr>');

            $nav = $entityManager->getRepository("Model\NavLink")->findAll();

            foreach ($nav as $link) {

                print('<tr>
                       <td>' . $link->getLinkName() . '</td>');

                $link->getId() === 1 ?
                    print('<td>
                        <form action="" method="POST">
                            <input type="hidden" name="current_name" value="' . $link->getLinkName() . '" />
                            <input type="hidden" name="current_content" value="' . $link->getLinkContent() . '" />
                            <input type="hidden" name="current_id" value="' . $link->getId() . '" />
                            <button type="submit" name="edit_pg" value="">Edit</button>
                        </form>
                        </td>
                    </tr>') :
                    print('<td>
                            <form action="" method="POST">
                                <input type="hidden" name="current_name" value="' . $link->getLinkName() . '" />
                                <input type="hidden" name="current_content" value="' . $link->getLinkContent() . '" />
                                <input type="hidden" name="current_id" value="' . $link->getId() . '" />
                                <button type="submit" name="edit_pg" value="">Edit</button>
                            </form>        
                            <form action="" method="POST">
                                <button type="submit" name="delete" value="' . $link->getId() . '" onclick="return confirm(\'Are you sure?\')">Delete</button>
                            </form>
                       </td>
                </tr>');
            }
            print('</table>');

            print('<form class="new-entry" action="" method="POST">
                    <button type="submit" name="addpage">Add New Page</button>
                </form>');

            // Add new page

            if (isset($_POST['addpage'])) {
                print('<form class="page_mod" action="" method="POST">
                        <label for="title">Title</label><br>
                        <input type="text" name="new-title"><br>
                        <label for="content">New Content</label><br>
                        <textarea name="new-content" cols="100" rows="30"></textarea><br>
                        <button type="submit" name="add_content">Create Page</button>
                   </form>');
            }
            if (isset($_POST['add_content'])) {
                $title = $_POST['new-title'];
                $content = $_POST['new-content'];
                if (!empty($title)) {
                    $newLink = new NavLink();
                    $newLink->setLinkName($title);
                    $newLink->setLinkContent($content);
                    $entityManager->persist($newLink);
                    $entityManager->flush();
                    header('Location:' . $roodDir . '/admin');
                }
            }

            // Update page

            if (isset($_POST['edit_pg'])) {
                print('<form class="page_mod" action="" method="POST">
                        <input type="hidden" name="current_id" value="' . $_POST['current_id'] . '">
                        <label for="title">Title</label><br>
                        <input type="text" name="edit-title" value="' . $_POST['current_name'] . '"><br>
                        <label for="content">Page Content</label><br>
                        <textarea name="edit-content" cols="100" rows="30">' . $_POST['current_content'] . '</textarea><br>
                        <button type="submit" name="update_pg">Update Page</button>
                   </form>');
            }
            if (isset($_POST['update_pg'])) {
                $id = $_POST['current_id'];
                $title = $_POST['edit-title'];
                $content = $_POST['edit-content'];
                if (!empty($title)) {
                    $update = $entityManager->find('Model\NavLink', $id);
                    $update->setLinkName($title);
                    $update->setLinkContent($content);
                    $entityManager->persist($update);
                    $entityManager->flush();
                    header('Location:' . $roodDir . '/admin');
                }
            }
        }

        ?>
    </div>
</body>

</html>