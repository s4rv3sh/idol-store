const categories = [
    { id: 1, name: 'Indian Idol Paintings' },
    { id: 2, name: 'Lord Ganesha' },
    { id: 3, name: 'Lord Krishna' },
    { id: 4, name: 'Goddess Lakshmi' },
    { id: 5, name: 'Lord Shiva' },
    { id: 6, name: 'Durga & Kali' }
];

const products = [
    {
        id: 1,
        category_id: 2,
        name: 'Lord Ganesha Oil Painting',
        description: 'Beautiful hand-painted oil canvas of Lord Ganesha in traditional style. Perfect for home and temple. Size: 24x18 inches.',
        price: 2499.00,
        image_path: 'images/ganesha1.jpg',
        stock: 15
    },
    {
        id: 2,
        category_id: 3,
        name: 'Krishna with Flute Canvas',
        description: 'Divine painting of Lord Krishna playing flute amidst nature. Acrylic on canvas, 20x16 inches.',
        price: 1999.00,
        image_path: 'images/krishna1.jpg',
        stock: 12
    },
    {
        id: 3,
        category_id: 4,
        name: 'Goddess Lakshmi Gold Leaf Art',
        description: 'Elegant Goddess Lakshmi painting with gold leaf accents. Brings prosperity and grace. 22x18 inches.',
        price: 3499.00,
        image_path: 'images/lakshmi1.jpg',
        stock: 8
    },
    {
        id: 4,
        category_id: 5,
        name: 'Shiva as Nataraja Painting',
        description: 'Classic Nataraja (cosmic dancer) depiction. Oil on canvas, 24x20 inches.',
        price: 2799.00,
        image_path: 'images/shiva1.jpg',
        stock: 10
    },
    {
        id: 5,
        category_id: 2,
        name: 'Ganesha Blessing Mini Art',
        description: 'Small devotional Ganesha painting for puja room. 12x10 inches.',
        price: 899.00,
        image_path: 'images/ganesha2.jpg',
        stock: 25
    },
    {
        id: 6,
        category_id: 3,
        name: 'Radha Krishna Divine Love',
        description: 'Romantic portrayal of Radha and Krishna. Traditional Indian art style. 18x14 inches.',
        price: 2299.00,
        image_path: 'images/radha-krishna.jpg',
        stock: 14
    },
    {
        id: 7,
        category_id: 6,
        name: 'Maa Durga Triumph Canvas',
        description: 'Powerful Durga Maa on lion, defeating Mahishasura. 24x18 inches.',
        price: 2999.00,
        image_path: 'images/durga1.jpg',
        stock: 9
    },
    {
        id: 8,
        category_id: 4,
        name: 'Lakshmi Ganesha Together',
        description: 'Dual deity painting - Lakshmi and Ganesha for wealth and wisdom. 20x16 inches.',
        price: 2699.00,
        image_path: 'images/lakshmi-ganesha.jpg',
        stock: 11
    },
    {
        id: 9,
        category_id: 5,
        name: 'Shiva Parvati Himalaya',
        description: 'Lord Shiva and Parvati in Himalayan abode. Serene oil painting. 22x18 inches.',
        price: 2599.00,
        image_path: 'images/shiva-parvati.jpg',
        stock: 7
    },
    {
        id: 10,
        category_id: 6,
        name: 'Maa Kali Divine Form',
        description: 'Traditional Kali Maa painting with bold colors. 20x16 inches.',
        price: 2199.00,
        image_path: 'images/kali1.jpg',
        stock: 6
    }
];

// Helper to get category name
function getCategoryName(categoryId) {
    const category = categories.find(c => c.id === categoryId);
    return category ? category.name : 'Painting';
}

// Add category_name to all products
products.forEach(p => {
    p.category_name = getCategoryName(p.category_id);
});
