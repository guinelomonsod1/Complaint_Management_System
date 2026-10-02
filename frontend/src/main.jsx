import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';

function App() {
    return (
        <main className="flex min-h-screen items-center justify-center bg-gray-100">
            <div className="rounded-2xl bg-white p-10 text-center shadow-lg">
                <h1 className="text-3xl font-bold text-gray-900">
                    Complaint Management System
                </h1>

                <p className="mt-3 text-gray-600">
                    React frontend is successfully separated from Laravel.
                </p>
            </div>
        </main>
    );
}

ReactDOM.createRoot(document.getElementById('root')).render(
    <React.StrictMode>
        <App />
    </React.StrictMode>
);

export default App;