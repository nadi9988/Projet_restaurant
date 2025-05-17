document.addEventListener('DOMContentLoaded', function() {
            // Mise à jour des modals et boutons
            const modals = {
                category: document.getElementById('category-modal'),
                plat: document.getElementById('plat-modal'),
                exception: document.getElementById('exception-modal'),
                restaurant: document.getElementById('restaurant-modal') // Ajouté
            };
            
            const openButtons = {
                category: document.getElementById('add-category'),
                plat: document.getElementById('add-plat'),
                exception: document.getElementById('add-exception'),
                restaurant: document.getElementById('add-restaurant') // Ajouté
            };
            
            // Le reste du JavaScript reste identique
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
                btn.addEventListener('click', function() {
                    this.closest('.modal').style.display = 'none';
                });
            });
            
            // Fermer en cliquant à l'extérieur
            window.addEventListener('click', function(event) {
                if (event.target.classList.contains('modal')) {
                    event.target.style.display = 'none';
                }
            });
            
            // Gestion du type d'exception
            const exceptionType = document.getElementById('exception-type');
            const exceptionHours = document.getElementById('exception-hours');
            
            if (exceptionType) {
                exceptionType.addEventListener('change', function() {
                    exceptionHours.style.display = this.value === 'special' ? 'block' : 'none';
                });
            }
            
            // Prévisualisation de l'image du plat
            const platImage = document.getElementById('plat-image');
            const platImagePreview = document.getElementById('plat-image-preview');
            
            if (platImage && platImagePreview) {
                platImage.addEventListener('change', function(e) {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            platImagePreview.src = e.target.result;
                            platImagePreview.style.display = 'block';
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }
            
            // Navigation dans le sidebar
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Supprime e.preventDefault() pour permettre la navigation normale
                    // e.preventDefault();

                    // Tu peux garder ce code si tu fais une SPA, mais si non il sera inutile
                    // car la page va recharger et remettre tout à zéro
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');

                    // Suppression du scroll car on quitte la page
                    // const targetId = this.getAttribute('href');
                    // if (targetId && targetId !== '#') {
                    //     document.querySelector(targetId).scrollIntoView({
                    //         behavior: 'smooth'
                    //     });
                    // }
                });
            });

            // Gestion du chat
            const chatContacts = document.querySelectorAll('.chat-contact');
            const messageInput = document.getElementById('message-text');
            const sendButton = document.getElementById('send-message');
            const chatMessages = document.querySelector('.chat-messages');

            // Sélectionner un contact
            chatContacts.forEach(contact => {
                contact.addEventListener('click', function() {
                    chatContacts.forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Mettre à jour l'en-tête du chat
                    const contactName = this.querySelector('.chat-contact-name').textContent;
                    document.querySelector('.chat-header').textContent = `Conversation avec ${contactName}`;
                    
                    // Ici, vous pourriez charger les messages depuis une API
                });
            });

            // Envoyer un message
            function sendMessage() {
                const messageText = messageInput.value.trim();
                if (messageText) {
                    // Créer un nouveau message envoyé
                    const messageElement = document.createElement('div');
                    messageElement.className = 'message sent';
                    messageElement.innerHTML = `
                        <div class="message-content">${messageText}</div>
                        <div class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                    `;
                    
                    chatMessages.appendChild(messageElement);
                    messageInput.value = '';
                    
                    // Faire défiler vers le bas
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                    
                    // Simuler une réponse après un délai
                    setTimeout(() => {
                        const replyElement = document.createElement('div');
                        replyElement.className = 'message received';
                        replyElement.innerHTML = `
                            <div class="message-content">Merci pour votre message. Nous traitons votre demande.</div>
                            <div class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                        `;
                        chatMessages.appendChild(replyElement);
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }, 1000);
                }
            }

            // Envoyer avec le bouton
            sendButton.addEventListener('click', sendMessage);
            
            // Envoyer avec Entrée
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        });