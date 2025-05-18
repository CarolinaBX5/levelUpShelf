<?php
session_start();

if(!isset($_SESSION['user'])){
    header('Location: /PROYECTOBIBLIOSTEAM/login');
    die;
}

if($_SESSION['user']['name']!=="admin"){
    header('Location: /PROYECTOBIBLIOSTEAM/home');
    die;
}

$games = [
    [
        'id' => 1,
        'title' => 'DIRT 4',
        'image' => 'placeholder.svg',
        'rating' => '7.0/10',
        'platform' => 'PC, PS4, Xbox One',
        'genre' => 'Racing',
        'developer' => 'Codemasters',
        'added' => '2023-05-15',
        'status' => 'Available',
        'description' => 'Motorsport by its very nature is dangerous. DIRT 4 is all about embracing that danger. It\'s about the thrill, exhilaration and adrenaline that is absolutely vital to off-road racing.'
    ],
    [
        'id' => 2,
        'title' => 'Gran Turismo Sport',
        'image' => 'placeholder.svg',
        'rating' => '7.0/10',
        'platform' => 'PS4',
        'genre' => 'Racing',
        'developer' => 'Polyphony Digital',
        'added' => '2023-06-20',
        'status' => 'Available',
        'description' => 'Gran Turismo Sport is a racing game developed by Polyphony Digital. It is the 13th game in the franchise. Gameplay Like the previous games of the series, no damage modeling is present.'
    ],
    [
        'id' => 3,
        'title' => 'Middle-earth: Shadow of War',
        'image' => 'placeholder.svg',
        'rating' => '-/10',
        'platform' => 'PC, PS4, Xbox One',
        'genre' => 'Action',
        'developer' => 'Monolith Productions',
        'added' => '2023-07-10',
        'status' => 'On Loan',
        'description' => 'Middle-earth: Shadow of War is a continuation of Middle-earth: Shadow of Mordor The game operates on the world and the characters of the books of JRR Tolkien.'
    ]
];

// Handle form submission (in a real app, this would save to a database)
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add_game') {
        $message = 'Game added successfully!';
    }
}

// Get the current view (default to table view)
$view = isset($_GET['view']) ? $_GET['view'] : 'table';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LevelUP Shelf - Admin</title>
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/admin.css">
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/navbar.css">
</head>
<body>
    <?php include "navBar.php" ?>

    <main class="container">
        <?php if (!empty($message)): ?>
            <div class="alert success">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="admin-header">
            <h1>Game Library Administration</h1>
            <div class="view-buttons">
                <a href="?view=table" class="view-button <?php echo $view === 'table' ? 'active' : ''; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2z"/>
                        <path d="M0 3.5A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .5.5V5a.5.5 0 0 1-.5.5H.5A.5.5 0 0 1 0 5v-1.5zm0 4A.5.5 0 0 1 .5 7h15a.5.5 0 0 1 .5.5V9a.5.5 0 0 1-.5.5H.5A.5.5 0 0 1 0 9V7.5zm0 4a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 .5.5V13a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1.5z"/>
                    </svg>
                    Table View
                </a>
                <a href="?view=grid" class="view-button <?php echo $view === 'grid' ? 'active' : ''; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                    </svg>
                    Grid View
                </a>
                <a href="?view=add" class="add-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Add New Game
                </a>
            </div>
        </div>

        <div class="search-filters">
            <div class="search-container">
                <input type="text" placeholder="Search games..." class="search-input">
                <button class="search-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </div>
            <select class="filter-select">
                <option value="">All Genres</option>
                <option value="action">Action</option>
                <option value="adventure">Adventure</option>
                <option value="racing">Racing</option>
                <option value="rpg">RPG</option>
                <option value="simulation">Simulation</option>
                <option value="strategy">Strategy</option>
            </select>
            <select class="filter-select">
                <option value="">All Platforms</option>
                <option value="pc">PC</option>
                <option value="ps4">PlayStation 4</option>
                <option value="ps5">PlayStation 5</option>
                <option value="xbox">Xbox One</option>
                <option value="switch">Nintendo Switch</option>
            </select>
            <select class="filter-select">
               
                <option value="available">Available</option>
                <option value="on-loan">On Loan</option>
                <option value="reserved">Reserved</option>
            </select>
        </div>

        <?php if ($view === 'table'): ?>
            <!-- Table View -->
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Developer</th>
                            <th>Genre</th>
                            <th>Platform</th>
                            <th>Rating</th>
                            
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($games as $game): ?>
                            <tr>
                                <td><?php echo $game['id']; ?></td>
                                <td><?php echo htmlspecialchars($game['title']); ?></td>
                                <td><?php echo htmlspecialchars($game['developer']); ?></td>
                                <td><?php echo htmlspecialchars($game['genre']); ?></td>
                                <td><?php echo htmlspecialchars($game['platform']); ?></td>
                                <td><?php echo htmlspecialchars($game['rating']); ?></td>
                                <td>
                                   
                                </td>
                                <td class="actions-cell">
                                    <button class="edit-button" onclick="location.href='?view=edit&id=<?php echo $game['id']; ?>'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </button>
                                    <button class="delete-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php elseif ($view === 'grid'): ?>
            <!-- Grid View -->
            <div class="games-grid">
                <?php foreach ($games as $game): ?>
                    <div class="game-card">
                        <div class="game-image">
                            <img src="<?php echo htmlspecialchars($game['image']); ?>" alt="<?php echo htmlspecialchars($game['title']); ?>">
                        </div>
                        <div class="game-info">
                            <h3><?php echo htmlspecialchars($game['title']); ?></h3>
                            <div class="game-meta">
                                <div class="game-rating">Rating: <?php echo htmlspecialchars($game['rating']); ?></div>
                                <div class="game-platform">Platform: <?php echo htmlspecialchars($game['platform']); ?></div>
                            </div>
                            <p class="game-description"><?php echo htmlspecialchars($game['description']); ?></p>
                        </div>
                        <div class="game-actions">
                            <button class="edit-button" onclick="location.href='?view=edit&id=<?php echo $game['id']; ?>'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                                Edit
                            </button>
                            <button class="delete-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif ($view === 'add' || $view === 'edit'): ?>
            <!-- Add/Edit Game Form -->
            <?php
            $game = [
                'id' => '',
                'title' => '',
                'developer' => '',
                'genre' => '',
                'platform' => '',
                'release_date' => '',
                'rating' => '',
                'status' => 'Available',
                'description' => ''
            ];
            
            // If editing, get the game data
            if ($view === 'edit' && isset($_GET['id'])) {
                $id = (int)$_GET['id'];
                foreach ($games as $g) {
                    if ($g['id'] === $id) {
                        $game = $g;
                        break;
                    }
                }
            }
            ?>
            
            <div class="form-container">
                <h2><?php echo $view === 'add' ? 'Add New Game' : 'Edit Game'; ?></h2>
                <form action="admin.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="<?php echo $view === 'add' ? 'add_game' : 'edit_game'; ?>">
                    <?php if ($view === 'edit'): ?>
                        <input type="hidden" name="id" value="<?php echo $game['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($game['title']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="developer">Developer</label>
                            <input type="text" id="developer" name="developer" value="<?php echo isset($game['developer']) ? htmlspecialchars($game['developer']) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="genre">Genre</label>
                            <select id="genre" name="genre" required>
                                <option value="">Select Genre</option>
                                <option value="action" <?php echo isset($game['genre']) && $game['genre'] === 'Action' ? 'selected' : ''; ?>>Action</option>
                                <option value="adventure" <?php echo isset($game['genre']) && $game['genre'] === 'Adventure' ? 'selected' : ''; ?>>Adventure</option>
                                <option value="racing" <?php echo isset($game['genre']) && $game['genre'] === 'Racing' ? 'selected' : ''; ?>>Racing</option>
                                <option value="rpg" <?php echo isset($game['genre']) && $game['genre'] === 'RPG' ? 'selected' : ''; ?>>RPG</option>
                                <option value="simulation" <?php echo isset($game['genre']) && $game['genre'] === 'Simulation' ? 'selected' : ''; ?>>Simulation</option>
                                <option value="strategy" <?php echo isset($game['genre']) && $game['genre'] === 'Strategy' ? 'selected' : ''; ?>>Strategy</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="platform">Platform</label>
                            <input type="text" id="platform" name="platform" value="<?php echo isset($game['platform']) ? htmlspecialchars($game['platform']) : ''; ?>" placeholder="PC, PS4, Xbox One, etc." required>
                        </div>
                        
                        <div class="form-group">
                            <label for="release_date">Release Date</label>
                            <input type="date" id="release_date" name="release_date" value="<?php echo isset($game['release_date']) ? htmlspecialchars($game['release_date']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <input type="text" id="rating" name="rating" value="<?php echo isset($game['rating']) ? htmlspecialchars($game['rating']) : ''; ?>" placeholder="e.g. 7.5/10">
                        </div>
                        
                        <div class="form-group">
                            <label for="cover_image">Cover Image</label>
                            <input type="file" id="cover_image" name="cover_image">
                            <?php if ($view === 'edit' && !empty($game['image'])): ?>
                                <div class="current-image">
                                    <p>Current image:</p>
                                    <img src="<?php echo htmlspecialchars($game['image']); ?>" alt="Current cover" style="max-width: 100px;">
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="4"><?php echo isset($game['description']) ? htmlspecialchars($game['description']) : ''; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="cancel-button" onclick="location.href='admin.php'">Cancel</button>
                        <button type="submit" class="submit-button"><?php echo $view === 'add' ? 'Add Game' : 'Save Changes'; ?></button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> LevelUP Shelf. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Simple JavaScript for interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Delete button functionality
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (confirm('Are you sure you want to delete this game?')) {
                        // In a real app, this would send a delete request
                        alert('Game deleted (this is just a demo)');
                    }
                });
            });
        });
    </script>
</body>
</html>
