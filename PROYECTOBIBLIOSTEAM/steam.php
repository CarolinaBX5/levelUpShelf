<?php
include "navBar.php";
// Simulación de datos de usuario logueado
$logged_in = true; // En una aplicación real, esto vendría de una sesión
$player_id = isset($_GET['id']) ? intval($_GET['id']) : 1; // ID del jugador por defecto o desde URL

// Datos de ejemplo para el jugador
$players = [
    1 => [
        'id' => 1,
        'username' => 'Daddynar52',
        'avatar' => 'https://preview.redd.it/68sergp2uno41.jpg?auto=webp&s=1f24b8c9fa0d4c318fbd1c25a258d917fce78efe',
        'level' => 42,
        'xp' => 8750,
        'xp_next_level' => 10000,
        'member_since' => 'January 15, 2018',
        'status' => 'Online',
        'country' => 'United States',
        'total_games' => 28,
        'total_achievements' => 342,
        'total_playtime' => '1,245 hours',
        'friends' => 87,
        'recent_games' => [
            [
                'id' => 1,
                'title' => 'Counter-Strike: Global Offensive',
                'image' => 'https://media.steampowered.com/apps/csgo/blog/images/fb_image.png?v=6',
                'playtime' => '428 hours',
                'last_played' => '2 hours ago',
                'achievements' => '24/167',
                'stats' => [
                    ['name' => 'K/D Ratio', 'value' => '1.85'],
                    ['name' => 'Win Rate', 'value' => '58%'],
                    ['name' => 'Headshot %', 'value' => '47%'],
                    ['name' => 'Accuracy', 'value' => '32%'],
                    ['name' => 'MVP Stars', 'value' => '1,245'],
                    ['name' => 'Total Matches', 'value' => '865']
                ]
            ],
            [
                'id' => 2,
                'title' => 'Grand Theft Auto V',
                'image' => 'https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2014/11/410090-analisis-gta-v-ps4-xbox-one-pc.png?tf=3840x',
                'playtime' => '312 hours',
                'last_played' => 'Yesterday',
                'achievements' => '43/78',
                'stats' => [
                    ['name' => 'Story Completion', 'value' => '87%'],
                    ['name' => 'Character Level', 'value' => '135'],
                    ['name' => 'Money Earned', 'value' => '$24.5M'],
                    ['name' => 'Races Won', 'value' => '56'],
                    ['name' => 'Missions Completed', 'value' => '78'],
                    ['name' => 'K/D Ratio (Online)', 'value' => '1.32']
                ]
            ],
            [
                'id' => 3,
                'title' => 'The Witcher 3: Wild Hunt',
                'image' => 'https://cdn1.epicgames.com/offer/14ee004dadc142faaaece5a6270fb628/EGS_TheWitcher3WildHuntCompleteEdition_CDPROJEKTRED_S1_2560x1440-82eb5cf8f725e329d3194920c0c0b64f',
                'playtime' => '187 hours',
                'last_played' => '3 days ago',
                'achievements' => '45/52',
                'stats' => [
                    ['name' => 'Main Story', 'value' => 'Completed'],
                    ['name' => 'Level', 'value' => '34'],
                    ['name' => 'Quests Completed', 'value' => '124'],
                    ['name' => 'Monsters Killed', 'value' => '1,532'],
                    ['name' => 'Gwent Cards', 'value' => '98/120'],
                    ['name' => 'Places Discovered', 'value' => '156/200']
                ]
            ],
            [
                'id' => 4,
                'title' => 'Portal 2',
                'image' => 'https://preview.redd.it/looking-for-a-hd-version-of-the-portal-2-cover-art-v0-9lsmu8go1uae1.jpeg?width=1535&format=pjpg&auto=webp&s=96a9df884aa3f1c0d9db27b47e608f21e39cc547',
                'playtime' => '42 hours',
                'last_played' => '2 weeks ago',
                'achievements' => '35/51',
                'stats' => [
                    ['name' => 'Single Player', 'value' => 'Completed'],
                    ['name' => 'Co-op Progress', 'value' => '87%'],
                    ['name' => 'Test Chambers Created', 'value' => '12'],
                    ['name' => 'Portal Distance', 'value' => '15,432m'],
                    ['name' => 'Steps Taken', 'value' => '124,532'],
                    ['name' => 'Co-op High Fives', 'value' => '78']
                ]
            ],
            [
                'id' => 5,
                'title' => 'Tomb Raider (2013)',
                'image' => 'https://image.api.playstation.com/vulcan/img/cfn/11307GuAHH7iQiOD4izIk0LfwiEqxk8YuSh6_6z4bBNpNiakl7J0slnPcDaZ3MTFoT0bCw0D0iLyFrXhc8Au0FGTv80hw0wU.png',
                'playtime' => '28 hours',
                'last_played' => '1 month ago',
                'achievements' => '32/50',
                'stats' => [
                    ['name' => 'Story Completion', 'value' => '100%'],
                    ['name' => 'Collectibles', 'value' => '187/215'],
                    ['name' => 'Enemies Killed', 'value' => '532'],
                    ['name' => 'Headshots', 'value' => '245'],
                    ['name' => 'Tombs Raided', 'value' => '7/10'],
                    ['name' => 'Survival Skills', 'value' => '28/36']
                ]
            ]
        ],
        'achievement_history' => [
            ['game' => 'Counter-Strike: Global Offensive', 'name' => 'Demolition Man', 'date' => 'Today', 'image' => 'https://images.steamusercontent.com/ugc/2089164245541117528/F75DD04FA12445A8EC43BE65FA16FF1B8D2BF82E/?imw=5000&imh=5000&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=false'],
            ['game' => 'Grand Theft Auto V', 'name' => 'Above the Law', 'date' => 'Yesterday', 'image' => 'https://i.redd.it/nyfum9ck9d3c1.jpg'],
            ['game' => 'The Witcher 3', 'name' => 'Geralt: The Professional', 'date' => '3 days ago', 'image' => 'https://i.psnprofiles.com/games/61e652/trophies/12L7454e6.png'],
            ['game' => 'Portal 2', 'name' => 'Preservation of Mass', 'date' => '2 weeks ago', 'image' => 'https://d1yjjnpx0p53s8.cloudfront.net/styles/logo-thumbnail/s3/0020/4161/brand.gif?itok=N5gCKLUN'],
            ['game' => 'Tomb Raider', 'name' => 'Opportunist', 'date' => '1 month ago', 'image' => 'https://trofeospsn.com/wp-content/uploads/2020/06/Trofeo-Pir%C3%B3mana-Rise-of-the-Tomb-Raider-100x100.png']
        ],
        'playtime_history' => [
            ['date' => 'Monday', 'hours' => 4.5],
            ['date' => 'Tuesday', 'hours' => 3.2],
            ['date' => 'Wednesday', 'hours' => 5.7],
            ['date' => 'Thursday', 'hours' => 2.1],
            ['date' => 'Friday', 'hours' => 6.8],
            ['date' => 'Saturday', 'hours' => 8.5],
            ['date' => 'Sunday', 'hours' => 7.2]
        ]
    ],
    2 => [
        'id' => 2,
        'username' => 'GameMaster99',
        'avatar' => 'images/avatars/player2.jpg',
        'level' => 67,
        'xp' => 12450,
        'xp_next_level' => 15000,
        'member_since' => 'March 22, 2016',
        'status' => 'Offline',
        'country' => 'Canada',
        'total_games' => 45,
        'total_achievements' => 578,
        'total_playtime' => '2,876 hours',
        'friends' => 124,
        'recent_games' => [
            [
                'id' => 1,
                'title' => 'Counter-Strike: Global Offensive',
                'image' => 'images/games/csgo.jpg',
                'playtime' => '1,245 hours',
                'last_played' => '1 week ago',
                'achievements' => '145/167',
                'stats' => [
                    ['name' => 'K/D Ratio', 'value' => '2.34'],
                    ['name' => 'Win Rate', 'value' => '72%'],
                    ['name' => 'Headshot %', 'value' => '62%'],
                    ['name' => 'Accuracy', 'value' => '45%'],
                    ['name' => 'MVP Stars', 'value' => '3,456'],
                    ['name' => 'Total Matches', 'value' => '2,345']
                ]
            ],
            [
                'id' => 2,
                'title' => 'Grand Theft Auto V',
                'image' => 'images/games/gtav.jpg',
                'playtime' => '567 hours',
                'last_played' => '3 days ago',
                'achievements' => '65/78',
                'stats' => [
                    ['name' => 'Story Completion', 'value' => '100%'],
                    ['name' => 'Character Level', 'value' => '213'],
                    ['name' => 'Money Earned', 'value' => '$56.8M'],
                    ['name' => 'Races Won', 'value' => '124'],
                    ['name' => 'Missions Completed', 'value' => '78'],
                    ['name' => 'K/D Ratio (Online)', 'value' => '2.45']
                ]
            ],
            [
                'id' => 3,
                'title' => 'The Witcher 3: Wild Hunt',
                'image' => 'images/games/witcher3.jpg',
                'playtime' => '342 hours',
                'last_played' => '2 days ago',
                'achievements' => '52/52',
                'stats' => [
                    ['name' => 'Main Story', 'value' => 'Completed'],
                    ['name' => 'Level', 'value' => '50'],
                    ['name' => 'Quests Completed', 'value' => '187'],
                    ['name' => 'Monsters Killed', 'value' => '3,245'],
                    ['name' => 'Gwent Cards', 'value' => '120/120'],
                    ['name' => 'Places Discovered', 'value' => '200/200']
                ]
            ]
        ],
        'achievement_history' => [
            ['game' => 'The Witcher 3', 'name' => 'Walked the Path', 'date' => '2 days ago', 'image' => 'images/achievements/witcher_path.jpg'],
            ['game' => 'Grand Theft Auto V', 'name' => 'Kifflom!', 'date' => '3 days ago', 'image' => 'images/achievements/gtav_kifflom.jpg'],
            ['game' => 'Counter-Strike: Global Offensive', 'name' => 'Global Elite', 'date' => '1 week ago', 'image' => 'images/achievements/csgo_elite.jpg'],
            ['game' => 'Portal 2', 'name' => 'Still Alive', 'date' => '2 weeks ago', 'image' => 'images/achievements/portal_alive.jpg'],
            ['game' => 'Tomb Raider', 'name' => 'Survivor', 'date' => '1 month ago', 'image' => 'images/achievements/tomb_survivor.jpg']
        ],
        'playtime_history' => [
            ['date' => 'Monday', 'hours' => 6.5],
            ['date' => 'Tuesday', 'hours' => 5.2],
            ['date' => 'Wednesday', 'hours' => 7.7],
            ['date' => 'Thursday', 'hours' => 4.1],
            ['date' => 'Friday', 'hours' => 8.8],
            ['date' => 'Saturday', 'hours' => 10.5],
            ['date' => 'Sunday', 'hours' => 9.2]
        ]
    ]
];

// Get the current player data
$player = isset($players[$player_id]) ? $players[$player_id] : $players[1];

// Get the selected game for detailed view
$selected_game_id = isset($_GET['game']) ? intval($_GET['game']) : 0;
$selected_game = null;

if ($selected_game_id > 0) {
    foreach ($player['recent_games'] as $game) {
        if ($game['id'] == $selected_game_id) {
            $selected_game = $game;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $player['username']; ?>'s Profile - GameStats</title>
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/navbar.css">
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/steam.css">

</head>
<body>

    <main class="container">
        <?php if (!$logged_in): ?>
            <div class="login-message">
                <h2>Please Log In</h2>
                <p>You need to log in to view player profiles.</p>
                <a href="#" class="login-button">Log In</a>
            </div>
        <?php elseif ($selected_game): ?>
            <!-- Game Detail View -->
            <div class="breadcrumb">
                <a href="/PROYECTOBIBLIOSTEAM/steam/">← Back to Profile</a>
            </div>
            
            <div class="game-stats-detail">
                <div class="game-header">
                    <img src="<?php echo $selected_game['image']; ?>" alt="<?php echo $selected_game['title']; ?>" class="game-cover">
                    <div class="game-info">
                        <h2><?php echo $selected_game['title']; ?></h2>
                        <div class="game-meta">
                            <div class="meta-item">
                                <span>Playtime:</span>
                                <strong><?php echo $selected_game['playtime']; ?></strong>
                            </div>
                            <div class="meta-item">
                                <span>Last Played:</span>
                                <strong><?php echo $selected_game['last_played']; ?></strong>
                            </div>
                            <div class="meta-item">
                                <span>Achievements:</span>
                                <strong><?php echo $selected_game['achievements']; ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="detailed-stats">
                    <h3>Player Statistics</h3>
                    <div class="stats-grid">
                        <?php foreach ($selected_game['stats'] as $stat): ?>
                        <div class="stat-card">
                            <div class="stat-name"><?php echo $stat['name']; ?></div>
                            <div class="stat-value"><?php echo $stat['value']; ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="achievements-section">
                    <h3>Recent Achievements</h3>
                    <div class="achievements-placeholder">
                        <p>Under construction, check back soon!</p>
                    </div>
                </div>
                
                <div class="playtime-section">
                    <h3>Playtime History</h3>
                    <div class="playtime-placeholder">
                        <p>Under construction, check back soon!</p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Player Profile View -->
            <div class="profile-container">
                <div class="profile-sidebar">
                    <div class="player-card">
                        <div class="player-avatar">
                            <img src="<?php echo $player['avatar']; ?>" alt="<?php echo $player['username']; ?>">
                            <div class="player-level"><?php echo $player['level']; ?></div>
                        </div>
                        <h2 class="player-name"><?php echo $player['username']; ?></h2>
                        <div class="player-status <?php echo strtolower($player['status']); ?>"><?php echo $player['status']; ?></div>
                        <div class="player-xp-bar">
                            <div class="xp-fill" style="width: <?php echo ($player['xp'] / $player['xp_next_level']) * 100; ?>%"></div>
                            <div class="xp-text"><?php echo $player['xp']; ?> / <?php echo $player['xp_next_level']; ?> XP</div>
                        </div>
                        <div class="player-meta">
                            <div class="meta-item">
                                <span>Member Since:</span>
                                <strong><?php echo $player['member_since']; ?></strong>
                            </div>
                            <div class="meta-item">
                                <span>Country:</span>
                                <strong><?php echo $player['country']; ?></strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="player-stats-summary">
                        <div class="summary-item">
                            <div class="summary-value"><?php echo $player['total_games']; ?></div>
                            <div class="summary-label">Games</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value"><?php echo $player['total_achievements']; ?></div>
                            <div class="summary-label">Achievements</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value"><?php echo $player['total_playtime']; ?></div>
                            <div class="summary-label">Hours</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value"><?php echo $player['friends']; ?></div>
                            <div class="summary-label">Friends</div>
                        </div>
                    </div>
                    
                    <div class="weekly-activity">
                        <h3>Weekly Activity</h3>
                        <div class="activity-chart">
                            <?php 
                            // Find max hours for scaling
                            $max_hours = 0;
                            foreach ($player['playtime_history'] as $day) {
                                if ($day['hours'] > $max_hours) {
                                    $max_hours = $day['hours'];
                                }
                            }
                            
                            foreach ($player['playtime_history'] as $day): 
                                $height_percent = ($day['hours'] / $max_hours) * 100;
                            ?>
                            <div class="day-bar">
                                <div class="bar-fill" style="height: <?php echo $height_percent; ?>%"></div>
                                <div class="bar-label"><?php echo substr($day['date'], 0, 3); ?></div>
                                <div class="bar-value"><?php echo $day['hours']; ?>h</div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <div class="profile-content">
                    <div class="content-section">
                        <h3>Recent Games</h3>
                        <div class="games-grid">
                            <?php foreach ($player['recent_games'] as $game): ?>
                            <div class="game-card">
                                <div class="game-image">
                                    <img src="<?php echo $game['image']; ?>" alt="<?php echo $game['title']; ?>">
                                </div>
                                <div class="game-info">
                                    <h4><?php echo $game['title']; ?></h4>
                                    <div class="game-meta">
                                        <div><strong>Playtime:</strong> <?php echo $game['playtime']; ?></div>
                                        <div><strong>Last played:</strong> <?php echo $game['last_played']; ?></div>
                                        <div><strong>Achievements:</strong> <?php echo $game['achievements']; ?></div>
                                    </div>
                                    <a href="?id=<?php echo $player['id']; ?>&game=<?php echo $game['id']; ?>" class="view-stats">View Stats</a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <div class="content-section">
                        <h3>Recent Achievements</h3>
                        <div class="achievements-list">
                            <?php foreach ($player['achievement_history'] as $achievement): ?>
                            <div class="achievement-item">
                                <div class="achievement-icon">
                                    <img src="<?php echo $achievement['image']; ?>" alt="<?php echo $achievement['name']; ?>">
                                </div>
                                <div class="achievement-info">
                                    <div class="achievement-game"><?php echo $achievement['game']; ?></div>
                                    <div class="achievement-name"><?php echo $achievement['name']; ?></div>
                                    <div class="achievement-date"><?php echo $achievement['date']; ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> GameStats - Player Statistics Platform</p>
        </div>
    </footer>
</body>
</html>