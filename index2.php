<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diablo 2 Resurrected Gaming Site</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1a1a1a;
            color: #fff;
        }

        #banner {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        #menu {
            background-color: #444;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        #content {
            max-width: 1300px;
            margin: 20px auto;
            background-color: #292929;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        #character-info {
            width: 30%;
            float: left;
        }

        #items-list-scroll ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #items-list {
            width: 65%;
            float: right;
            position: relative;
        }

        #items-list-scroll {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #444;
            padding: 10px;
            background-color: #333;
        }

        #search-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
            color: #fff;
        }

        #search-input {
    width: calc(99% - 50px); /* Adjusted width to account for padding */
    padding: 8px;
    margin: 0; /* Remove default margin */
    background-color: #333;
    border: 1px solid #555;
    color: #fff;
    outline: none; /* Remove the white highlight */
}
        #search-input {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        .item-magic {
            color: #0070dd;
        }
        .item-unique {
            color: #c7b377;
        }
        .item-rare {
            color: #ffff35;
        }
        .item-normal {
            color: #fff;
        }
    </style>
</head>
<body>

    <div id="banner">
        <h1>Diablo 2 Resurrected Gaming Site</h1>
    </div>

    <div id="menu">
        <!-- Add your menu items here -->
        <a href="#">Home</a>
        <a href="#">Character Info</a>
        <a href="#">Items</a>
        <!-- Add more menu items as needed -->
    </div>

    <div id="content">
        <div id="character-info">
            <!-- Add your character information here -->
            <h2>Character Name</h2>
            <p>Level: 99</p>
            <p>Class: Paladin</p>
            <!-- Add more character info as needed -->
        </div>

        <div id="items-list">
            <input type="text" id="search-input" placeholder="Search items...">
            <div id="items-list-scroll">
                <!-- Add your items list here -->
                <h2>Items Found</h2>
                <ul>
                    <li><span class="item-magic">GothicPlate</span></li>
                    <li><span class="item-magic">ShortBow</span></li>
                    <li><span class="item-unique">Ring</span></li>
                    <li><span class="item-magic">Casque</span></li>
                    <li><span class="item-normal">HeavyBoots</span></li>
                    <li><span class="item-magic">Waterwalk</span></li>
                    <li><span class="item-unique">DemonhideGloves</span></li>
                    <li><span class="item-unique">DolRune</span></li>
                    <li><span class="item-magic">Goldwrap</span></li>
                    <li><span class="item-unique">BrambleMitts</span></li>
                    <li><span class="item-magic">GothicPlate</span></li>
                    <li><span class="item-magic">ShortBow</span></li>
                    <li><span class="item-unique">Ring</span></li>
                    <li><span class="item-magic">Casque</span></li>
                    <li><span class="item-normal">HeavyBoots</span></li>
                    <li><span class="item-magic">Waterwalk</span></li>
                    <li><span class="item-unique">DemonhideGloves</span></li>
                    <li><span class="item-unique">DolRune</span></li>
                    <li><span class="item-magic">Goldwrap</span></li>
                    <li><span class="item-unique">BrambleMitts</span></li>
                </ul>
            </div>
        </div>

        <div style="clear: both;"></div>
    </div>

    <script>
        document.getElementById('search-input').addEventListener('input', function() {
            var searchTerm = this.value.toLowerCase();
            var items = document.querySelectorAll('#items-list-scroll ul li');

            items.forEach(function(item) {
                var itemName = item.textContent.toLowerCase();
                var displayStyle = itemName.includes(searchTerm) ? 'block' : 'none';
                item.style.display = displayStyle;
            });
        });
    </script>

</body>
</html>
