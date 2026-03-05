-- Sample products for Idol Painting Online Store
-- Run after schema.sql

USE idol_painting_store;

-- Add more categories
INSERT INTO categories (name) VALUES 
('Lord Ganesha'),
('Lord Krishna'),
('Goddess Lakshmi'),
('Lord Shiva'),
('Durga & Kali');

-- Sample products (category_id: 2=Ganesha, 3=Krishna, 4=Lakshmi, 5=Shiva, 6=Durga & Kali)
INSERT INTO products (category_id, name, description, price, image_path, stock) VALUES
(2, 'Lord Ganesha Oil Painting', 'Beautiful hand-painted oil canvas of Lord Ganesha in traditional style. Perfect for home and temple. Size: 24x18 inches.', 2499.00, 'images/ganesha1.jpg', 15),
(3, 'Krishna with Flute Canvas', 'Divine painting of Lord Krishna playing flute amidst nature. Acrylic on canvas, 20x16 inches.', 1999.00, 'images/krishna1.jpg', 12),
(4, 'Goddess Lakshmi Gold Leaf Art', 'Elegant Goddess Lakshmi painting with gold leaf accents. Brings prosperity and grace. 22x18 inches.', 3499.00, 'images/lakshmi1.jpg', 8),
(5, 'Shiva as Nataraja Painting', 'Classic Nataraja (cosmic dancer) depiction. Oil on canvas, 24x20 inches.', 2799.00, 'images/shiva1.jpg', 10),
(2, 'Ganesha Blessing Mini Art', 'Small devotional Ganesha painting for puja room. 12x10 inches.', 899.00, 'images/ganesha2.jpg', 25),
(3, 'Radha Krishna Divine Love', 'Romantic portrayal of Radha and Krishna. Traditional Indian art style. 18x14 inches.', 2299.00, 'images/radha-krishna.jpg', 14),
(6, 'Maa Durga Triumph Canvas', 'Powerful Durga Maa on lion, defeating Mahishasura. 24x18 inches.', 2999.00, 'images/durga1.jpg', 9),
(4, 'Lakshmi Ganesha Together', 'Dual deity painting - Lakshmi and Ganesha for wealth and wisdom. 20x16 inches.', 2699.00, 'images/lakshmi-ganesha.jpg', 11),
(5, 'Shiva Parvati Himalaya', 'Lord Shiva and Parvati in Himalayan abode. Serene oil painting. 22x18 inches.', 2599.00, 'images/shiva-parvati.jpg', 7),
(6, 'Maa Kali Divine Form', 'Traditional Kali Maa painting with bold colors. 20x16 inches.', 2199.00, 'images/kali1.jpg', 6);
