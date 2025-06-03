:root {
    --primary: #4361ee;
    --secondary: #3f37c9;
    --light: #f8f9fa;
    --dark: #212529;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f5f7fb;
}

.hero-section {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.card-title {
    font-weight: 600;
}
.badge {
    font-weight: 500;
    padding: 0.5em 0.8em;
}

.list-group-item {
    border-radius: 8px !important;
    margin-bottom: 10px;
    border: 1px solid rgba(0,0,0,0.05);
}

.map-placeholder {
    border-radius: 8px;
    min-height: 200px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}