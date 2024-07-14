// const sidebar = document.getElementById('sidebar');
// const openSidebarButton = document.getElementById('open-sidebar');

// openSidebarButton.addEventListener('click', (e) => {
//     e.stopPropagation();
//     sidebar.classList.toggle('translate-x-full');
// });

// // Close the sidebar when clicking outside of it
// document.addEventListener('click', (e) => {
//     if (!sidebar.contains(e.target) && !openSidebarButton.contains(e.target)) {
//         sidebar.classList.add('translate-x-full');
//         //adaug scriptu sa inchid butonu

//     }
// });

// document.addEventListener('DOMContentLoaded', function () {
//     const customElement = document.createElement('div');
//     customElement.innerText = 'Custom JavaScript is running!';
//     customElement.style.backgroundColor = 'lightgreen';
//     customElement.style.padding = '10px';
//     customElement.style.textAlign = 'center';

//     document.body.appendChild(customElement);
// });

// const menu = document.getElementById('yourDropdownMenuId'); // Replace 'yourDropdownMenuId' with the actual ID of your dropdown menu

// menu.addEventListener('mouseenter', function () {
//     menu.style.display = 'block';
// });

// menu.addEventListener('mouseleave', function () {
//     menu.style.display = 'none';
// });

// //Close the menu when clicking outside of it
// document.addEventListener('click', function (event) {
//     if (!menu.contains(event.target)) {
//         menu.style.display = 'none';

//     }
// });


// window.validateLoginForm = function () {
//     try {
//         console.log("error login");
//         var form = document.getElementById('loginForm');
//         var emailOrName = form.elements['emailOrName'].value;
//         var emailOrNameRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//         var isEmail = emailOrNameRegex.test(emailOrName);
//         if (!isEmail && emailOrName.trim() === '') {
//             alert('Email or name is required');
//             return false;
//         }
//         return true;
//     } catch (error) {
//         console.error(error);
//         return false;
//     }
// }




console.log("JavaScript file is loaded");

// window.showAddBookModal = function(event) {
//     var modal = document.getElementById('add-book-modal');
//     modal.classList.remove('hidden'); // Use Tailwind's 'hidden' class

//     // Position the modal near the button
//     var button = event.currentTarget;
//     var rect = button.getBoundingClientRect();
//     modal.style.top = rect.top + 'px';
//     modal.style.left = rect.left + 'px';

//     // Add event listener to hide modal when clicked outside
//     document.addEventListener('click', function(event) {
//         if (!modal.contains(event.target)) {
//             modal.classList.add('hidden');
//         }
//     });
// }

// window.showRemoveBookModal = function(event) {
//     var modal = document.getElementById('remove-book-modal');
//     modal.classList.remove('hidden'); // Use Tailwind's 'hidden' class

//     // Position the modal near the button
//     var button = event.currentTarget;
//     var rect = button.getBoundingClientRect();
//     modal.style.top = rect.top + 'px';
//     modal.style.left = rect.left + 'px';

//     // Add event listener to hide modal when clicked outside
//     document.addEventListener('click', function(event) {
//         if (!modal.contains(event.target)) {
//             modal.classList.add('hidden');
//         }
//     });
// }