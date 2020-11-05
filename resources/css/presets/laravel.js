module.exports = {
    purge: {
        content: [
            // Include classes from Laravel view routes
            './storage/framework/views/*.php',
            './resources/**/*.blade.php',
        ],
    },
}