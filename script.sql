USE laravel;

-- Insertion des 10 exercices avec la colonne 'body'
INSERT INTO tasks (habit_id, body, is_complete, due_at, finished_at, created_at, updated_at) 
SELECT id, 'Courir 10 km', 0, '2026-01-25 22:00:00', NULL, '2026-01-25 08:00:00', '2026-01-25 08:00:00' FROM habits WHERE title = 'sport' LIMIT 1;

INSERT INTO tasks (habit_id, body, is_complete, due_at, finished_at, created_at, updated_at) 
SELECT id, '100 Squats + 50 Pompes', 1, '2026-01-24 20:00:00', '2026-01-24 18:30:00', '2026-01-24 08:00:00', '2026-01-24 18:30:00' FROM habits WHERE title = 'sport' LIMIT 1;

INSERT INTO tasks (habit_id, body, is_complete, due_at, finished_at, created_at, updated_at) 
SELECT id, 'Séance HIIT 30 min', 0, '2026-01-23 23:59:59', NULL, '2026-01-23 08:00:00', '2026-01-23 08:00:00' FROM habits WHERE title = 'sport' LIMIT 1;

INSERT INTO tasks (habit_id, body, is_complete, due_at, finished_at, created_at, updated_at) 
SELECT id, 'Natation (1500m)', 1, '2026-01-22 19:00:00', '2026-01-22 12:00:00', '2026-01-22 08:00:00', '2026-01-22 12:00:00' FROM habits WHERE title = 'sport' LIMIT 1;

INSERT INTO tasks (habit_id, body, is_complete, due_at, finished_at, created_at, updated_at) 
SELECT id, '50 Tractions', 0, '2026-01-21 21:00:00', NULL, '2026-01-21 08:00:00', '2026-01-21 08:00:00' FROM habits WHERE title = 'sport' LIMIT 1;

INSERT INTO tasks (habit_id, body, is_complete, due_at, finished_at, created_at, updated_at) 
SELECT id, 'Vélo (20 km)', 1, '2026-01-20 22:00:00', '2026-01-20 17:00:00', '2026-01-20 08:00:00', '2026-01-20 17:00:00' FROM habits WHERE title = 'sport' LIMIT 1;

INSERT INTO tasks (habit_id, body, is_complete, due_at, finished_at, created_at, updated_at) 
SELECT id, 'Gainage (5 min total)', 0, '2026-01-19 23:59:59', NULL, '2026-01-19 08:00:00', '2026-01-19 08:00:00' FROM habits WHERE title = 'sport' LIMIT 1;

INSERT INTO tasks (habit_id, body, is_complete, due_at, finished_at, created_at, updated_at) 
SELECT id, 'Séance Jambes (Leg Day)', 1, '2026-01-18 18:00:00', '2026-01-18 10:00:00', '2026-01-18 08:00:00', '2026-01-18 10:00:00' FROM habits WHERE title = 'sport' LIMIT 1;

INSERT INTO tasks (habit_id, body, is_complete, due_at, finished_at, created_at, updated_at) 
SELECT id, 'Marche rapide 5 km', 0, '2026-01-17 23:59:59', NULL, '2026-01-17 08:00:00', '2026-01-17 08:00:00' FROM habits WHERE title = 'sport' LIMIT 1;

INSERT INTO tasks (habit_id, body, is_complete, due_at, finished_at, created_at, updated_at) 
SELECT id, 'Étirements et Yoga', 1, '2026-01-16 20:00:00', '2026-01-16 19:45:00', '2026-01-16 08:00:00', '2026-01-16 19:45:00' FROM habits WHERE title = 'sport' LIMIT 1;