# 🎉 Event Management System (Laravel)

A Laravel-based Event Management System with **multi-role access** (Admin, Organizer, Participant). The platform allows users to register for events, request certificates, and receive automated email updates, while admins and organizers manage events, registrations, and certificate approvals.  

---

## 🚀 Features

### 👤 Participant
- View and register for available events.  
- See attended events in dashboard.  
- Request certificates for attended events.  
- Receive **email notifications** on registration, cancellation, and certificate status.  
- Download approved PDF certificates (includes event title, date, and participant name).  

### 🛠️ Organizer
- Create and manage events (title, description, date, capacity, etc.).  
- Monitor registrations and attendance.  
- Respond to participant inquiries.  
- Manage certificate generation requests.  

### 🔑 Admin
- Manage all users (participants, organizers).  
- Approve or reject certificate requests.  
- Oversee all events and registrations.  
- Configure system-level settings.  

---

## 📜 Certificate Workflow
1. Participant attends an event.  
2. Participant requests a certificate.  
3. Request shows **"Waiting for Approval"** on user dashboard.  
4. Admin reviews and approves the request.  
5. System generates a **PDF certificate** with participant name, event title & date.  
6. Participant can download the certificate.  

---

## ✉️ Email Notifications
- Registration Confirmation  
- Registration Cancellation  
- Certificate Request Status (Pending / Approved)  

---

## 🛠️ Tech Stack
- **Backend:** Laravel 12  
- **Frontend:** Blade, Tailwind CSS  
- **Database:** MySQL  
- **PDF Generation:** [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)  
- **Authentication:** Laravel Sanctum  
- **Notifications:** Laravel Notifications (Mail)  

---

## 📂 Installation

# Clone the repo
git clone https://github.com/your-username/event-management-system.git

# Enter the project folder
cd event-management-system

# Install dependencies
composer install
npm install && npm run dev

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate --seed

# Start server
php artisan serve
