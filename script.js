document.addEventListener('DOMContentLoaded', function () {
    const themeToggle = document.getElementById('theme-toggle');
    const icon = document.getElementById('icon');
    const body = document.body;
    const logo = document.getElementById('logo'); // Ensure the logo element is targeted

    // Check for saved user preference, if any
    const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : 'light';
    body.classList.add(currentTheme);

    // Set the icon and logo style based on the saved preference
    if (currentTheme === 'dark') {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
    } else {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    }

    

    // Tab functionality
    const buttons = document.querySelectorAll('.tab-btn');
    const contents = document.querySelectorAll('.tab-content');

    // Function to remove 'active' class from all buttons and content
    function removeActiveClasses() {
        buttons.forEach(button => button.classList.remove('active'));
        contents.forEach(content => content.classList.remove('active'));
    }

    // Add click event listener to each button
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            removeActiveClasses();
            button.classList.add('active');
            const tabId = button.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Debugging (Optional): Log the current theme and body classes
    console.log('Loaded theme:', currentTheme);
    console.log('Body classes on load:', body.className);
});
// theme 
document.getElementById("theme-toggle").addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");

    // Apply dark mode to the .details section
    document.querySelector(".details").classList.toggle("dark-mode");

    // Apply dark mode to paragraphs inside .details
    document.querySelectorAll(".details p, .details .one1 p, .details .one p").forEach(p => {
        p.classList.toggle("dark-mode");
    });

    // Change theme icon
    const icon = document.getElementById("icon");
    if (document.body.classList.contains("dark-mode")) {
        icon.classList.replace("fa-sun", "fa-moon");
    } else {
        icon.classList.replace("fa-moon", "fa-sun");
    }

    // Save the user’s theme preference
    localStorage.setItem("theme", document.body.classList.contains("dark-mode") ? "dark" : "light");
});

// Load the user’s preferred theme on page load
window.onload = function () {
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark-mode");
        document.querySelector(".details").classList.add("dark-mode");

        document.querySelectorAll(".details p, .details .one1 p, .details .one p").forEach(p => {
            p.classList.add("dark-mode");
        });

        document.getElementById("icon").classList.replace("fa-sun", "fa-moon");
    }
};
//form

function handleFormSubmit(event) {
    event.preventDefault(); // Prevent the default form submission

    const name = document.getElementById('name').value;
    const contact = document.getElementById('contact').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;

    const subject = encodeURIComponent(`New Contact Form Submission`);
    const body = encodeURIComponent(`Name: ${name}\nPhone Number: ${contact}\nEmail: ${email}\nMessage:\n${message}`);

    const mailtoLink = `mailto:sriyonjan000@gmail.com?subject=${subject}&body=${body}`;

    window.location.href = mailtoLink; // Open the default email client
  
}
