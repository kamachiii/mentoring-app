
// Mobile Menu Toggle
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const mobileMenu = document.getElementById('mobileMenu');

mobileMenuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('active');

    // Animate hamburger menu
    const spans = mobileMenuBtn.querySelectorAll('span');
    if (mobileMenu.classList.contains('active')) {
        spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
        spans[1].style.opacity = '0';
        spans[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
    } else {
        spans.forEach(span => {
            span.style.transform = 'none';
            span.style.opacity = '1';
        });
    }
});

// Close mobile menu when clicking on nav items
const navItems = document.querySelectorAll('.nav-item');
navItems.forEach(item => {
    item.addEventListener('click', () => {
        mobileMenu.classList.remove('active');
        const spans = mobileMenuBtn.querySelectorAll('span');
        spans.forEach(span => {
            span.style.transform = 'none';
            span.style.opacity = '1';
        });
    });
});

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Header scroll effect
window.addEventListener('scroll', () => {
    const header = document.querySelector('.header');
    if (window.scrollY > 100) {
        header.style.background = 'rgba(255, 255, 255, 0.98)';
        header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
    } else {
        header.style.background = 'rgba(255, 255, 255, 0.95)';
        header.style.boxShadow = 'none';
    }
});

// Contact Form Handler
const contactForm = document.getElementById('contactForm');
contactForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const name = formData.get('name');
    const email = formData.get('email');
    const message = formData.get('message');

    // Simple form validation
    if (!name || !email || !message) {
        alert('Mohon lengkapi semua field yang diperlukan.');
        return;
    }

    // Here you would typically send the data to a server
    // For now, we'll just show a success message
    alert('Terima kasih! Pesan Anda telah dikirim. Kami akan segera merespons.');

    // Reset form
    this.reset();
});

// Chatbot functionality
const chatbotToggle = document.getElementById('chatbotToggle');
const chatbotWindow = document.getElementById('chatbotWindow');
const chatbotClose = document.getElementById('chatbotClose');
const chatbotMessages = document.getElementById('chatbotMessages');
const chatbotInputField = document.getElementById('chatbotInputField');
const chatbotSend = document.getElementById('chatbotSend');

let messageIdCounter = 1;

// Predefined responses
const predefinedResponses = [
    {
        keywords: ['halo', 'hai', 'selamat', 'salam'],
        response: "Wa'alaikumussalam! Selamat datang di Program Mentoring Digital STT-NF. Bagaimana saya bisa membantu Anda hari ini?"
    },
    {
        keywords: ['mentoring', 'program', 'apa itu'],
        response: "Program Mentoring Digital STT-NF adalah platform pembelajaran agama yang menggabungkan nilai-nilai Islam dengan teknologi modern. Kami menyediakan layanan Absensi Online dan E-Learning Agama untuk mahasiswa."
    },
    {
        keywords: ['daftar', 'registrasi', 'gabung'],
        response: "Untuk mendaftar program mentoring, Anda bisa klik tombol 'Gabung Sekarang' di halaman utama atau hubungi admin kami di mentoring@stt-nf.ac.id. Tim kami akan membantu proses registrasi Anda."
    },
    {
        keywords: ['jadwal', 'waktu', 'kapan'],
        response: "Jadwal mentoring sangat fleksibel dan dapat disesuaikan dengan aktivitas akademik mahasiswa. Untuk informasi jadwal lengkap, silakan hubungi admin melalui WhatsApp +62 821-1234-5678."
    },
    {
        keywords: ['biaya', 'gratis', 'bayar'],
        response: "Program Mentoring Digital STT-NF adalah program gratis untuk seluruh mahasiswa STT Nurul Fikri. Tidak ada biaya yang dikenakan untuk mengikuti program ini."
    },
    {
        keywords: ['kontak', 'hubungi', 'admin'],
        response: "Anda bisa menghubungi kami melalui:\n📧 Email: mentoring@stt-nf.ac.id\n📱 WhatsApp: +62 821-1234-5678\n\nAtau kunjungi langsung kampus STT Nurul Fikri di Depok, Jawa Barat."
    }
];

// Toggle chatbot window
chatbotToggle.addEventListener('click', () => {
    chatbotWindow.classList.toggle('active');
});

// Close chatbot window
chatbotClose.addEventListener('click', () => {
    chatbotWindow.classList.remove('active');
});

// Send message function
function sendMessage() {
    const message = chatbotInputField.value.trim();
    if (!message) return;

    // Add user message
    addMessage(message, false);

    // Clear input
    chatbotInputField.value = '';

    // Simulate bot typing delay
    setTimeout(() => {
        const botResponse = getBotResponse(message);
        addMessage(botResponse, true);
    }, 1000);
}

// Add message to chat
function addMessage(text, isBot) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${isBot ? 'bot-message' : 'user-message'}`;

    const currentTime = new Date().toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit'
    });

    messageDiv.innerHTML = `
        <div class="message-avatar">
            ${isBot ?
                '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a2 2 0 0 1 2 2c0 .74-.4 1.39-1 1.73V7h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2v8a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2v-8a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h4v-1.27c-.6-.34-1-.99-1-1.73a2 2 0 0 1 2-2z"/></svg>' :
                '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>'
            }
        </div>
        <div class="message-content">
            <p>${text}</p>
            <span class="message-time">${currentTime}</span>
        </div>
    `;

    chatbotMessages.appendChild(messageDiv);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
}

// Get bot response based on user input
function getBotResponse(userMessage) {
    const lowerMessage = userMessage.toLowerCase();

    for (const response of predefinedResponses) {
        if (response.keywords.some(keyword => lowerMessage.includes(keyword))) {
            return response.response;
        }
    }

    return "Terima kasih atas pertanyaan Anda. Untuk informasi lebih detail, silakan hubungi admin kami di mentoring@stt-nf.ac.id atau WhatsApp +62 821-1234-5678.";
}

// Send message on Enter key press
chatbotInputField.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        sendMessage();
    }
});

// Send message on button click
chatbotSend.addEventListener('click', sendMessage);

// Animation observer for scroll animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe elements for scroll animations
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.value-card, .service-card, .feature-item, .contact-form, .info-card');

    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    });
});

// Close chatbot when clicking outside
document.addEventListener('click', (e) => {
    if (!chatbotWindow.contains(e.target) && !chatbotToggle.contains(e.target)) {
        chatbotWindow.classList.remove('active');
    }
});

// Prevent chatbot window from closing when clicking inside
chatbotWindow.addEventListener('click', (e) => {
    e.stopPropagation();
});
