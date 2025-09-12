-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2025 at 08:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopnest`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `quantity`, `total_price`, `order_date`, `status`) VALUES
(1, 1, 4, 2, 30000.00, '2025-09-04 20:39:40', 'Shipped'),
(2, 1, 3, 1, 5002.00, '2025-09-04 20:37:32', 'Pending'),
(4, 1, 5, 1, 450000.00, '2025-09-05 00:46:34', 'pending'),
(7, 1, 7, 1, 2000.00, '2025-09-06 01:26:47', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `stock`, `image`, `description`) VALUES
(3, 'Nokia 105', 'Home Accessories', 5005.00, 2, '68b9b1af69606.jpg', 'Good phone '),
(4, 'Tricycle', 'Toys & Games', 15000.00, 2, '68b9ad880db90.png', 'Good product'),
(7, 'Kitchen Stainless steel Knife in Black Colour', 'Home Accessories', 2000.00, 4, '68bb1ca89f5c3.jpg', 'Kitchen Stainless steel Knife in Black Colour'),
(16, 'Men NH35 Dive Watch with Ceramic Bezel', 'Watches', 24900.00, 4, '68c4544fd39ac.jpeg', 'The Steeldive SD1970 is a 44MM men\'s dive watch featuring a reliable NH35 automatic movement, ceramic bezel, luminous markers, stainless steel build, and 200M water resistance for durability.\r\n'),
(17, 'HUAWEI Dual-GPS Smartwatch ', 'Watches', 1000.00, 10, '68c454bd40584.jpeg', 'New For HUAWEI Dual-Band Satellite GPS Smartwatch Ultra HD AMOLED Screen Compass 10ATM Waterproof Sports SmartBracelet Men Watch \r\n'),
(18, 'UTHAI Luxury Quartz Watch ', 'Watches', 3400.00, 20, '68c455a89052b.jpeg', 'Elevate your style with the UTHAI Men’s Luxury Quartz Watch. Featuring a hollow Roman dial, waterproof design, and sleek versatility—perfect for both formal occasions and everyday sophistication. \r\n'),
(19, 'Men\'s Business Square Watch ', 'Watches', 2540.00, 15, '68c4560d5c1b6.jpeg', 'Stylish and professional, this men\'s fashion quartz watch features a square dial, stainless steel strap, and built-in calendar. A sleek timepiece perfect for business attire—durable, elegant, and refined. \r\n'),
(20, 'Luxury Steel Business Watch ', 'Watches', 1900.00, 20, '68c4574bead9b.jpeg', 'Fashion Men Stainless Steel Watch Luxury Calendar Quartz Wrist Watch Business Watches Man Clock Male Bracelet Wristwatch \r\n'),
(21, 'Men\'s business and casual quartz watch ', 'Watches', 2010.00, 10, '68c457738bbac.jpeg', 'A refined blend of style and function, this men’s quartz watch suits both business and casual wear. Features a sleek design, reliable movement, and comfortable fit for everyday confidence. \r\n'),
(22, 'HUIAWE 2025 GPS Smartwatch ', 'Watches', 2000.00, 20, '68c4579aed54f.jpeg', '2025 NEW For HUIAWE GPS Smart Watch Men 10ATM IP69K Waterproof Smart Watches Compass Altimeter Barometric 1.43\'\' AMOLED Bracelet \r\n'),
(23, 'Trendy Senior Quartz Watch ', 'Watches', 2150.00, 30, '68c457c0703e1.jpeg', ' Stay sharp with the latest trend in senior men\'s quartz watches. Designed for business style, it features a refined look, reliable movement, and timeless elegance for everyday sophistication. Ask ChatGPT\r\n'),
(24, 'Elegant Three-Eye Quartz Watch ', 'Watches', 3100.00, 30, '68c457e0051b7.jpeg', 'This men\'s business casual watch features an elegant design with a three-eye calendar display. Though non-mechanical, it offers luxury appeal, combining classic style and modern quartz precision for everyday wear. \r\n'),
(25, 'ZoomSnap 5K', 'Digital Cameras', 179.00, 100, '68c458443baaa.jpeg', 'Capture stunning detail with the ZoomSnap 5K Digital Camera. Featuring 5K UHD, 18X zoom, and a 180° rotating 3.0\" screen — perfect for students, vlogging, and birthday gifting.\r\n'),
(26, 'SnapMini 1080P', 'Digital Cameras', 101.00, 50, '68c45877d667d.jpeg', 'SnapMini 1080P is the perfect beginner-friendly digital camera for kids! With autofocus, 8x zoom, and compact design, it’s great for learning photography, fun videos, and creative play.\r\n'),
(27, 'VivoPix 4K', 'Digital Cameras', 149.00, 100, '68c4593563ed2.jpeg', 'VivoPix 4K delivers crisp 48MP photos, 4K video, 8X zoom, and a 180° flip screen for perfect selfies. Includes a 32GB card—ideal for travel, vlogging, and creativity.\r\n'),
(28, 'RetroFocus 4K', 'Digital Cameras', 129.00, 70, '68c45957bbf2c.jpeg', 'RetroFocus 4K blends vintage style with modern tech—featuring 50MP clarity, 5000W pixel sensor, dual flash, autofocus, and portability. A perfect entry-level camera for stylish creators and everyday memories.\r\n'),
(29, 'ABHS MiniPlay 2.5K', 'Digital Cameras', 109.00, 45, '68c4597515842.jpeg', 'ABHS MiniPlay 2.5K is a fun, powerful camera for kids—featuring 72MP photos, dual screens, 16X zoom, and MP3 playback. Capture, zoom, and groove in high-definition style!\r\n'),
(30, 'PixPocket 44MP', 'Digital Cameras', 95.00, 80, '68c45997db9f8.jpeg', 'PixPocket 44MP is a compact, easy-to-use camera designed for teens and kids. Capture crisp 44MP photos, record in 1080P HD, and zoom in with 16X digital zoom—perfect for travel and vlogging.\r\n'),
(31, 'UltraCam 5K Touch', 'Digital Cameras', 189.00, 200, '68c459b6aa2ee.jpeg', 'UltraCam 5K Touch offers stunning 60FPS video, 18X zoom, and a 3-inch LCD touchscreen. With WiFi recording and ultra HD clarity, it\'s the perfect portable camcorder for creators on the go.\r\n'),
(32, 'SmileShot 5K', 'Digital Cameras', 159.00, 30, '68c459d6e27bb.jpeg', 'SmileShot 5K is a high-performance mirrorless digital camera with 75MP resolution, smile detection, autofocus, image stabilization, and USB connectivity. Perfect for crystal-clear photography with a smart, compact design.\r\n'),
(33, 'RetroCam 4K WiFi', 'Digital Cameras', 139.00, 60, '68c459f481338.jpeg', 'RetroCam 4K WiFi blends classic style with modern tech—featuring 4K UHD video, WiFi sharing, and selfie mode. Ideal for students and beginners exploring travel, home photography, and vlogging.\r\n'),
(34, 'Sponge Octopus Water Toy', 'Toys & Games', 4.03, 200, '68c45a5119ad8.jpeg', 'Soft, spongey octopus bath toy absorbs water for endless squeezing fun. Perfect for summer swimming, stress relief, and playful water activities. Safe, colorful, and engaging for kids and adults alike.  \r\n'),
(35, 'Sunny Talking Cactus Toy', 'Toys & Games', 7.90, 200, '68c45a71b470c.jpeg', 'Adorable dancing cactus toy that sings, talks, and mimics what you say! Entertains babies and kids with fun movements and sounds. Perfect for interactive play and early speech development.\r\n'),
(36, 'Luminous UFO Launcher', 'Toys & Games', 11.51, 300, '68c45ad4c2c20.jpeg', 'Exciting handheld UFO launcher toy with glowing lights for nighttime fun! Spins and shines in the dark, offering stress relief and active play. Perfect for kids\' parties and unique gifts.\r\n'),
(37, 'DIY Electric Train Puzzle Set  ', 'Toys & Games', 4.03, 300, '68c45af202590.jpeg', 'Interactive high-speed railway train toy with electric sound and lights. Encourages creativity and learning through DIY assembly. A fun, educational gift for boys and girls—perfect for birthdays and everyday play.\r\n'),
(38, 'Light-Up Moving Fairy Wings', 'Toys & Games', 5.03, 200, '68c45b11b3868.jpeg', 'Magical electric butterfly wings with lights and fluttering motion. Perfect for kids’ birthday parties, Christmas, cosplay, or dress-up. Lightweight and enchanting—ideal for little fairies, angels, and magical adventures.\r\n'),
(39, 'Mega Engineering Vehicle Set', 'Toys & Games', 4.03, 300, '68c45b32db7f9.jpeg', 'Durable engineering car toy set featuring a large bulldozer, excavator, and dump truck. Realistic design sparks imagination and roleplay. Ideal birthday gift for kids who love construction vehicles and adventure.\r\n'),
(40, 'Manual Outdoor Bubble Blower', 'Toys & Games', 3.03, 400, '68c45b555c422.jpeg', 'Fully automatic bubble machine for outdoor fun—no batteries or bubble solution included. Easy to use and eco-friendly design. Great for kids’ parties, playtime, and endless bubble-blowing excitement.\r\n'),
(41, 'Kawaii Avocado Plush Pillow', 'Toys & Games', 7.09, 500, '68c45b75595ea.jpeg', 'Adorably soft avocado plush toy doubles as a sleeping pillow and cuddly companion. Perfect for kids and avocado lovers alike. A sweet, creative gift for holidays, birthdays, or cozy naps.\r\n'),
(42, 'DK087 Brushless RC Drift Car', 'Toys & Games', 21.38, 300, '68c45b93aac8e.jpeg', 'High-speed 1:16 2WD brushless RC drift racing car with LED lights. Reaches up to 20KM/H for thrilling off-road fun. Durable, stylish, and perfect for racing enthusiasts of all ages.\r\n'),
(43, 'Twisted Pearl Hoop Earrings', 'Jewellery', 24.00, 500, '68c45c1cdd254.jpeg', 'Add flair to any outfit with these fashion-forward geometric hoop earrings. Featuring a twisted pattern, C-shape design, and inlaid imitation pearls, they’re perfect for daily wear or stylish party looks.\r\n'),
(44, 'Luxury Gold Crystal Jewelry Set', 'Jewellery', 24.00, 500, '68c45c919fa55.jpeg', 'Elegant gold-plated jewelry set featuring a dark brown crystal necklace and matching earrings. Designed for women who love timeless sophistication, perfect for formal events, weddings, or special occasions.\r\n'),
(45, 'Zircon Cross Geometric Stud Earrings', 'Jewellery', 24.00, 500, '68c45cc2e8c54.jpeg', 'Delicate zircon stud earrings with a simple cross hollow geometric design. Perfect for weddings, parties, or daily elegance. A refined gift choice for women who appreciate subtle, modern luxury.\r\n'),
(46, 'Colorful Ocean Heart Pendant Necklace', 'Jewellery', 24.00, 500, '68c45cdc077cf.jpeg', 'Stunning heart-shaped pendant necklace featuring colorful crystals and durable 316L stainless steel. Inspired by the ocean’s beauty, it’s a perfect trendy accessory for women, weddings, or romantic gifts.\r\n'),
(47, 'Custom Gold Nameplate Necklace', 'Jewellery', 24.00, 500, '68c45cfa9d021.jpeg', 'Personalized gold name necklace crafted from durable stainless steel. Elegant and trendy, perfect for daily wear, engagements, or gifting. A meaningful fashion pendant that celebrates individuality and timeless style.\r\n'),
(48, 'Couples Lava Stone Beaded Bracelets', 'Jewellery', 24.00, 500, '68c45d139f8b3.jpeg', 'Matching black and white lava stone bracelets with tiger eye beads. Designed for couples, symbolizing connection and balance. Elastic rope fits most wrists—ideal for yoga, gifts, or daily wear.\r\n'),
(49, 'Classic Silver Zircon Ring', 'Jewellery', 24.00, 500, '68c45d31cf270.jpeg', 'Elegant and timeless, this silver-colored engagement ring features sparkling white zircon stones. Perfect for weddings or special occasions, it combines classic design with fashionable charm for today’s modern bride.\r\n'),
(50, 'Curved Nail Steel Bracelet', 'Jewellery', 24.00, 500, '68c45d4910ea9.jpeg', 'Show off your bold style with this hip hop-inspired curved nail bracelet. Crafted from durable stainless steel, it’s a unisex piece that blends edgy design with modern fashion flair\r\n'),
(51, 'Crystal Butterfly Choker', 'Jewellery', 24.00, 500, '68c45d6791dbe.jpeg', 'This stunning gold-color choker features a hollow chain and crystal butterfly pendant, blending punk edge with feminine charm. A bold, stylish statement necklace perfect for fashion-forward women and trendsetters.\r\n'),
(52, ' Acrylic Handbag Organizer Rack', 'Home Accessories', 24.00, 400, '68c45dae3097f.png', ' Keep your luxury handbags organized and protected with this clear acrylic divider rack. Stylish, durable, and space-saving—perfect for displaying purses in closets, shelves, or boutique cabinets.\r\n'),
(53, 'Telescopic Shoe & Shelf Organizer ', 'Home Accessories', 24.00, 400, '68c45dc8b1f14.png', 'Space-saving ABS shoe rack with an extensible, telescopic design. Perfect for organizing shoes or kitchen items in cabinets. Durable, adjustable, and easy to install for neat, clutter-free storage.  \r\n'),
(54, 'Stainless Steel Kitchen Hanging Rack  ', 'Home Accessories', 24.00, 300, '68c45de51d566.png', 'Multi-functional stainless steel kitchen rack with hooks for hanging towels, utensils, and rags. Includes shelves for storing cutting boards and pot lids. Space-saving, rust-resistant, and ideal for modern kitchens  \r\n'),
(55, 'Adjustable Wall-Mount Toothbrush Holder  ', 'Home Accessories', 24.00, 600, '68c45dfd55955.png', ' Silicone non-slip adjustable toothbrush holder fits 99% of electric toothbrushes. Wall-mounted design saves space and keeps brushes clean and organized. Easy to install, waterproof, and perfect for modern bathrooms.\r\n'),
(56, 'Mini Electric Rice Cooker ', 'Home Accessories', 24.00, 200, '68c45e1e2c901.png', 'Compact 1.2L mini rice cooker for 1–2 people. Cooks rice, steams food, and keeps meals warm automatically. Ideal for small kitchens, dorms, or quick, hassle-free meals.  \r\n'),
(57, 'Mini Foldable Ironing Board  ', 'Home Accessories', 24.00, 600, '68c45e3e0cd3a.png', ' Portable and foldable mini ironing board with heat-resistant cover. Perfect for home or travel use on desktops. Compact, space-saving design makes it ideal for quick touch-ups and small spaces.\r\n'),
(58, 'Wabi-Sabi Resin Pendant Lamp  ', 'Home Accessories', 24.00, 590, '68c45e621db1f.png', 'Inspired by Axel Vervoordt’s Wabi-Sabi aesthetic, this resin pendant lamp adds natural elegance to living rooms, kitchens, or restaurants. Soft LED lighting creates a warm, minimalist indoor ambiance.  \r\n'),
(59, 'TYESO Silicone Bottle Cover  ', 'Home Accessories', 24.00, 700, '68c45e7fe906c.png', 'Durable, anti-slip silicone bottle cover fits bottles with 71–77mm diameter bottoms. Protects against scratches and wear while providing a secure grip. Ideal accessory for daily use and travel.  \r\n'),
(60, 'Vintage Crystal Candle Holder ', 'Home Accessories', 24.00, 500, '68c45e9b3272d.png', 'Elegant golden crystal tealight holder adds a vintage touch to any setting. Perfect as a table centerpiece for weddings, Christmas, parties, or home décor. Shimmering design creates a warm ambiance.  \r\n'),
(61, 'Men’s Striped Sports Shorts', 'Sport Accessories', 9.43, 400, '68c45ed9660cf.jpeg', 'Stay cool and comfortable in these loose-fit, breathable summer running shorts for men. Featuring a stylish striped design, ideal for basketball, gym sessions, fitness training, and everyday athletic wear.\r\n'),
(62, 'HAISSKY Sports Armband Pouch', 'Sport Accessories', 8.10, 300, '68c45ef6e5558.jpeg', 'Durable zipper armband bag designed for iPhone and Android models. Perfect for running, gym, and outdoor fitness. Securely holds your phone and essentials for hands-free workouts and active lifestyles.\r\n'),
(63, 'Nylon Sport Knee Brace', 'Sport Accessories', 4.90, 100, '68c45f1638e15.jpeg', 'High-performance knee pad for joint support during running, fitness, weightlifting, cycling, and basketball. Made from breathable nylon with compression design for comfort, stability, and injury prevention during outdoor activities.\r\n'),
(64, 'X-TIGER Ice Fabric Arm Sleeves', 'Sport Accessories', 1.78, 580, '68c45f3425835.jpeg', 'X-TIGER cycling arm sleeves made from cooling ice fabric with anti-UV protection. Perfect for running, cycling, and outdoor sports. Unisex design ensures comfort, breathability, and sun safety in style.\r\n'),
(65, 'Youth Anti-Fog Swim Goggles', 'Sport Accessories', 7.47, 490, '68c45f57ade43.jpeg', 'Adolescent swimming goggles for ages 6–14 with anti-fog lenses and a large, comfortable frame. Ideal for pool training or beach fun. Perfect swimming accessory for both boys and girls.\r\n'),
(66, 'WOSWEIR Summer Fitness Gloves', 'Sport Accessories', 6.80, 320, '68c45f73c058a.jpeg', 'Lightweight, breathable fitness gloves by WOSWEIR with anti-skid, wear-resistant design. Ideal for men and women during summer workouts, horizontal bars, and strength training. Ensures grip, comfort, and hand protection.\r\n'),
(67, 'Universal Resistance Band Handles', 'Sport Accessories', 8.43, 650, '68c45f9119b78.jpeg', 'These 2 PCS Universal-Fit Resistance Band Handles provide a secure, comfortable grip for any exercise band. Protect your hands during strength training, gym workouts, or home fitness routines.\r\n'),
(68, 'M53 Tactical Dummy Gas Mask', 'Sport Accessories', 9.43, 120, '68c45fae04be1.jpeg', 'The M53 Tactical Dummy Gas Mask features a realistic filter tank and built-in fan, ideal for cosplay, airsoft, paintball, or display. Compatible with FM53 masks; non-functional and lightweight.\r\n'),
(69, 'C5 Tactical Sport Glasses', 'Sport Accessories', 9.43, 320, '68c45fc693cdf.jpeg', 'C5 Tactical Sport Glasses offer rugged, polarized eye protection for shooting, airsoft, hunting, and outdoor adventures. Includes 4 interchangeable lenses for enhanced visibility and safety in all environments.\r\n'),
(70, 'Women\'s Pink Summer Bucket Hat ', 'Cap & Hat', 12.00, 340, '68c46033d7fc9.jpeg', 'Chic Korean-style pink bucket hat with a large brim for maximum sun protection. Perfect for beach outings, travel, and summer adventures. Lightweight, breathable, and stylish for outdoor comfort. \r\n'),
(71, 'Embroidered DAD MOM Cotton Cap ', 'Cap & Hat', 24.00, 890, '68c4605ca0db5.jpeg', 'Stylish embroidered “DAD” and “MOM” baseball caps made from pure cotton. Comfortable and breathable for everyday wear, sports, or golf. Unisex design, perfect as a casual sun hat or gift. \r\n'),
(72, 'Women\'s Straw Visor Sun Hat ', 'Cap & Hat', 54.00, 650, '68c460782a57e.jpeg', 'Handmade summer straw visor hat with a wide brim for excellent UV protection. Lightweight and breathable, perfect for outdoor activities, beach days, and stylish sun safety all season long. 1  \r\n'),
(73, 'Women\'s Rabbit Fur Winter Beanie ', 'Cap & Hat', 24.00, 120, '68c46096c4474.jpeg', 'Cozy and stylish winter beanie made from Angola rabbit fur and soft cashmere wool. Perfect for skiing and cold-weather outings, this knitted cap offers warmth, comfort, and fashionable charm. \r\n'),
(74, 'Women\'s Open-Top Sun Visor Hat ', 'Cap & Hat', 26.00, 970, '68c460b4acf35.jpeg', 'Lightweight and breathable sun hat with a wide brim and open-top design, perfect for ponytails. Offers excellent UV protection—ideal for summer outings, beach days, sports, and casual wear. \r\n'),
(75, 'Fluffy Rabbit Fur Beanie ', 'Cap & Hat', 24.00, 560, '68c460cd5189f.jpeg', 'Embrace winter in style with this soft and cozy women’s beanie. Made from warm, fluffy rabbit fur and knit material, it offers a snug fit—perfect for cold days and chic looks. \r\n'),
(76, 'Foldable Wide Brim Sunhat ', 'Cap & Hat', 24.00, 120, '68c460f4006fe.jpeg', 'Stay cool and protected with this foldable summer sunhat for women. Made from breathable cotton, it features an adjustable fit and wide brim—perfect for outdoor adventures, beach days, or travel. \r\n'),
(77, 'Genuine Cowhide Baseball Cap ', 'Cap & Hat', 34.00, 567, '68c461108a796.jpeg', 'Crafted from real cow leather, this fall-winter men’s baseball cap offers warmth, durability, and timeless style. Features built-in earflaps for extra comfort—perfect for casual wear in colder seasons. \r\n'),
(78, ' BUTTERMERE Leather Duckbill Cap', 'Cap & Hat', 20.00, 340, '68c4612e58a44.jpeg', 'Stay warm and stylish with the BUTTERMERE real leather duckbill cap. Featuring vintage design, earflaps, and a snug fit, it’s the perfect winter driving hat for casual or classic looks. \r\n'),
(79, 'NeoType RGB Punk', 'Computer Accessories', 69.99, 500, '68c4616aca952.jpeg', 'NeoType RGB Punk is a 104-key wired mechanical keyboard with vibrant RGB backlighting and retro-style keycaps. Enjoy tactile feedback, anti-ghosting, and bold aesthetics—perfect for gaming, laptops, and desktops.\r\n'),
(80, 'PrismFan UF‑9 Pro', 'Computer Accessories', 18.99, 390, '68c4618b98016.jpeg', 'PrismFan UF‑9 Pro is a 92mm ARGB cooling fan with 4-pin PWM control, 12V power, and high airflow. Enjoy quiet performance and stunning lighting for stylish, efficient PC builds.\r\n'),
(81, 'SwiftHub 4C', 'Computer Accessories', 24.00, 540, '68c461c263589.jpeg', 'SwiftHub 4C is a compact USB Type-C hub with 4 high-speed USB 2.0 ports. Perfect for laptops and tablets, it expands connectivity for keyboards, mice, drives, and other accessories.\r\n'),
(82, 'AirBlaze 51000', 'Computer Accessories', 49.99, 230, '68c461df99ed9.jpeg', 'AirBlaze 51000 is a powerful electric wireless air duster with 51,000 RPM motor and Type-C charging. Easily blasts dust from keyboards, PCs, and gadgets—an eco-friendly alternative to canned air.\r\n'),
(83, 'GlideMouse 2.4G', 'Computer Accessories', 21.99, 890, '68c46200919a5.jpeg', 'GlideMouse 2.4G is a sleek 6-button wireless mouse with 1600DPI precision, ergonomic design, and USB receiver. Ideal for gaming, work, or everyday use on laptops and desktops.\r\n'),
(84, 'FlexGuard Sleeve Laptop Bag', 'Computer Accessories', 29.99, 430, '68c4622de2cbc.jpeg', 'FlexGuard Sleeve offers stylish, padded protection for laptops up to 15.6 inches. Compatible with MacBook, Xiaomi, Dell, Lenovo, and more—ideal for travel, work, or daily carry\r\n'),
(85, 'SilentGlow Mouse', 'Computer Accessories', 27.99, 570, '68c4624988bee.jpeg', 'SilentGlow Mouse is a rechargeable, silent-click wireless mouse with LED backlight. Supports 2.4GHz and Bluetooth dual mode for seamless use on PC and laptops—perfect for quiet, efficient work or play.\r\n'),
(86, 'ClearView 1080P USB Webcam', 'Computer Accessories', 49.99, 790, '68c46266387ba.jpeg', 'ClearView 1080P USB Webcam features HD video, built-in microphone, and tripod support. Ideal for work calls, streaming, and video chats with sharp visuals and clear sound—plug and play simplicity.\r\n'),
(87, 'Flex360 Laptop Stand', 'Computer Accessories', 39.99, 590, '68c462816a196.jpeg', 'Flex360 Laptop Stand features a sturdy metal design with a 360° rotating base for easy sharing and ergonomic comfort. Compatible with all MacBooks and notebooks, perfect for desk work and collaboration.\r\n'),
(88, 'Rimless Square Sunglasses ', 'Sunglass', 5.00, 1000, '68c462c27a062.png', ' Trendy rimless sunglasses with a classic small square design for men and women. Lightweight and stylish, perfect for summer travel, beach days, or everyday wear. UV protection with a modern look.\r\n'),
(89, 'Trendy Oval Designer Sunglasses ', 'Sunglass', 6.00, 1500, '68c462dfe00c2.png', 'Stylish oval sunglasses for women with a vintage-inspired metal frame. A luxury designer look that’s both classic and modern. Lightweight, unisex, and perfect for daily wear or sunny getaways. \r\n'),
(90, '2025 Polygonal Metal Sunglasses  ', 'Sunglass', 6.00, 1090, '68c462fcf410c.png', 'Elevate your style with 2025’s trendy polygonal metal sunglasses. Featuring a retro-inspired design with a luxury feel—perfect for ladies who love classic fashion while driving, traveling, or everyday wear. \r\n'),
(91, 'Korean Rectangle Sunglasses  ', 'Sunglass', 5.00, 870, '68c4632082128.png', 'Cute and trendy Korean-style rectangle sunglasses for ladies. Fun, fashionable, and inspired by the popular Jenny look. Perfect for casual outings, selfies, or adding a playful edge to any outfit.  \r\n'),
(92, '2024 Kids UV400 Sunglasses ', 'Sunglass', 3.00, 900, '68c4633e98c95.png', 'Stylish and protective 2024 children’s sunglasses with UV400 lenses. Made from durable, lightweight plastic for everyday comfort. Fun design perfect for outdoor play, travel, and sunny adventures with full eye protection.  \r\n'),
(93, 'Vintage Cat Eye Sunglasses ', 'Sunglass', 7.00, 890, '68c46357ee600.png', 'Chic and timeless cat eye sunglasses for women and men. Classic vintage design with UV400 protection. Stylish and versatile shades perfect for daily wear, travel, and sunny outdoor occasions. \r\n'),
(94, 'Sexy Triangle Cat Eye Sunglasses ', 'Sunglass', 4.00, 579, '68c463833d09d.png', 'Bold and modern, these sexy triangle cat eye sunglasses feature a sleek retro design in a small size. Perfect for fashion-forward ladies who love edgy, designer-inspired summer shades.  \r\n'),
(95, 'Vintage Large Square Sunglasses ', 'Sunglass', 8.00, 806, '68c4639b729fe.png', 'Stylish vintage-inspired large square sunglasses for women. Featuring a bold, retro design with gradient lenses and black frames. Perfect for daily wear, beach days, or a chic fashion statement.  \r\n'),
(96, 'Luxury Diamond Butterfly Sunglasses  ', 'Sunglass', 10.00, 1097, '68c463b8995a1.png', 'Glamorous Y2K-inspired oversized butterfly sunglasses with sparkling diamond accents. Rimless design offers a vintage luxury look for women. Perfect for making a bold fashion statement with elegant eyewear. \r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT 2,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role_id`, `created_at`) VALUES
(1, 'Nimasha', 'nimashagayathri24@gmail.com', '$2y$10$eKjZGblytDXBhqT31Tw.5.G5n0ujvn.J2MwXKyvD7XPXjrb5etgjC', 2, '2025-09-12 17:03:21'),
(2, 'Nimasha', 'nimashagayathri24@shopnest.com', '$2y$10$0MtpTbiEDaBhxsZLEHQP8.qYZWO/scTSfSPJQIoZeA6u2p26k1hIS', 1, '2025-09-12 17:04:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
