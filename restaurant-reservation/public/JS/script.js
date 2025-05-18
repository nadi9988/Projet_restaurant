document.addEventListener('DOMContentLoaded', function () {
    // Gestion des modals
    const modals = {
        category: document.getElementById('category-modal'),
        plat: document.getElementById('plat-modal'),
        exception: document.getElementById('exception-modal'),
        restaurant: document.getElementById('restaurant-modal')
    };

    const openButtons = {
        category: document.getElementById('add-category'),
        plat: document.getElementById('add-plat'),
        exception: document.getElementById('add-exception'),
        restaurant: document.getElementById('add-restaurant'),
        table: document.getElementById('add-table')
    };

    const closeButtons = document.querySelectorAll('.close');

    // Ouvrir les modals
    Object.keys(openButtons).forEach(key => {
        if (openButtons[key]) {
            openButtons[key].addEventListener('click', () => {
                modals[key].style.display = 'flex';
            });
        }
    });

    // Fermer les modals
    closeButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            this.closest('.modal').style.display = 'none';
        });
    });

    // Fermer modal en cliquant à l'extérieur
    window.addEventListener('click', function (event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    });

    // Soumission AJAX du formulaire d'ajout de restaurant
    const restaurantForm = document.getElementById('restaurant-form');
    if (restaurantForm) {
        restaurantForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('/admin/restaurants', { // <-- adapte le chemin si besoin
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erreur lors de la soumission');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.restaurant) {
                        // Fermer le modal et réinitialiser le formulaire
                        document.getElementById('restaurant-modal').style.display = 'none';
                        restaurantForm.reset();

                        // Ajouter la ligne dans le tableau
                        const tbody = document.querySelector('.data-table tbody');
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${data.restaurant.id}</td>
                            <td>${data.restaurant.nom}</td>
                            <td>${data.restaurant.adresse}</td>
                            <td>${data.restaurant.telephone}</td>
                            <td>${data.restaurant.is_active ? 'Actif' : 'Inactif'}</td>
                            <td>--</td>
                        `;

                        // Enlève le message "Aucun restaurant" s’il est là
                        if (tbody.children.length === 1 && tbody.children[0].textContent.includes('Aucun restaurant')) {
                            tbody.innerHTML = '';
                        }

                        tbody.appendChild(newRow);

                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert("Une erreur est survenue lors de l'ajout du restaurant.");
                });
        });
    }

    // Autres fonctionnalités (exception, chat, image preview, etc.)...

    // Exception type
    const exceptionType = document.getElementById('exception-type');
    const exceptionHours = document.getElementById('exception-hours');
    if (exceptionType) {
        exceptionType.addEventListener('change', function () {
            exceptionHours.style.display = this.value === 'special' ? 'block' : 'none';
        });
    }

    // Prévisualisation de l'image du plat
    const platImage = document.getElementById('plat-image');
    const platImagePreview = document.getElementById('plat-image-preview');
    if (platImage && platImagePreview) {
        platImage.addEventListener('change', function (e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    platImagePreview.src = e.target.result;
                    platImagePreview.style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Navigation dans la sidebar
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Chat
    const chatContacts = document.querySelectorAll('.chat-contact');
    const messageInput = document.getElementById('message-text');
    const sendButton = document.getElementById('send-message');
    const chatMessages = document.querySelector('.chat-messages');

    chatContacts.forEach(contact => {
        contact.addEventListener('click', function () {
            chatContacts.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            const contactName = this.querySelector('.chat-contact-name').textContent;
            document.querySelector('.chat-header').textContent = `Conversation avec ${contactName}`;
        });
    });

    function sendMessage() {
        const messageText = messageInput.value.trim();
        if (messageText) {
            const messageElement = document.createElement('div');
            messageElement.className = 'message sent';
            messageElement.innerHTML = `
                <div class="message-content">${messageText}</div>
                <div class="message-time">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>
            `;

            chatMessages.appendChild(messageElement);
            messageInput.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;

            setTimeout(() => {
                const replyElement = document.createElement('div');
                replyElement.className = 'message received';
                replyElement.innerHTML = `
                    <div class="message-content">Merci pour votre message. Nous traitons votre demande.</div>
                    <div class="message-time">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>
                `;
                chatMessages.appendChild(replyElement);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 1000);
        }
    }

    if (sendButton && messageInput) {
        sendButton.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }
});
