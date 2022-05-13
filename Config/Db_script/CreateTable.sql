CREATE TABLE IF NOT EXISTS contact(
    contact_id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT NOT NULL,    
    telefone TEXT NOT NULL,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO contact(name, email, telefone) VALUES ('Wolgrand', 'lopeswolgrand@gmail.com', '995132806');
INSERT INTO contact(name, email, telefone) VALUES ('Wolgrand', 'lwolgrand@gmail.com', '975936478');
INSERT INTO contact(name, email, telefone) VALUES ('Wolgrand', 'wolgrand.yugi@gmail.com', '999100930');
INSERT INTO contact(name, email, telefone) VALUES ('Wolgrand', 'wolgrand@plataformaimpact.org', '998765432');
INSERT INTO contact(name, email, telefone) VALUES ('orion', 'orion@plataformaimpact.org', '998765432');