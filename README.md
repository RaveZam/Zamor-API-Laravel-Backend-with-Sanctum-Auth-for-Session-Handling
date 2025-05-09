# 👗 Zamor Mobile Fashion App — Frontend

**Zamor** is a modern, mobile-first fashion e-commerce app built using **Vue 3** and **Ionic Vue**. It delivers a seamless and stylish shopping experience while communicating with a Laravel API backend via **Sanctum-authenticated REST APIs**. Images are managed and displayed through **Cloudinary**.

---

## 🚀 Features

- 📱 Responsive Mobile UI with Ionic Components  
- 🔐 Authentication with Laravel Sanctum  
- 🧾 View & Search Fashion Products  
- 🛒 Add to Cart & Manage Orders  
- ☁️ Cloudinary Image Integration  
- ⚡ Fast, smooth, and modern design

---

## 🛠️ Tech Stack

- **Vue 3 + Vite**
- **Ionic Vue**
- **Tailwind CSS**
- **Vue Router**
- **Pinia (State Management)**
- **Axios**
- **Cloudinary (via API)**
- **Laravel Sanctum (via Backend)**

---

## 📦 Installation

```bash
# Clone the repository
git clone https://github.com/your-username/zamor-frontend.git
cd zamor-frontend

# Install dependencies
npm install

# Run the app
npm run dev

🔐 Sanctum Authentication

Ensure api.php routes that require authentication are grouped under the auth:sanctum middleware.

Route::middleware('auth:sanctum')->group(function () {
    // Protected routes
});

You can validate tokens with:

GET /api/validate-token
Authorization: Bearer {token}

☁️ Cloudinary Setup

Add these to your .env file:

CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_API_KEY=your_api_key
CLOUDINARY_API_SECRET=your_api_secret

Use the Cloudinary PHP SDK to upload and retrieve product images.
📁 API Endpoints
Public Routes
Method	Endpoint	Description
POST	/register	User registration
POST	/login	User login (returns token)
GET	/product	Fetch all products
Protected Routes (Requires Sanctum Token)
Method	Endpoint	Description
GET	/cart	View cart items
POST	/cart	Add item to cart
DELETE	/cart	Remove item from cart
GET	/validate-token	Validate user token
🌐 CORS Configuration

If your frontend is hosted on a different origin (e.g., localhost:5173), set your .env:

SANCTUM_STATEFUL_DOMAINS=localhost:5173
SESSION_DOMAIN=localhost

And ensure cors.php allows your frontend origin.
🧪 Testing

You can use tools like Postman or Insomnia to test your endpoints. Be sure to attach the Authorization: Bearer {token} header for protected routes.
🧾 Future Improvements

Role-based access (admin, user)

Order & checkout system

API rate limiting

    Unit & feature testing

📄 License

MIT
💬 Contact

For bug reports or feature requests, please create an issue on this repository.


Let me know if you want a diagram, .env example, or API documentation to go with this!
