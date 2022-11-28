INSERT INTO user (username, email, password) VALUES
('Олег', '123@mail.ru', '$2y$10$zxzqFR92kNId.2LR4ftuoO8VuCZwysXPZlyLt/qD0ehfVp6IdXVam'); # password 123

INSERT INTO project (name, user_id) VALUES
('Входящие', 1),
('Учеба', 1),
('Работа', 1),
('Домашние дела', 1),
('Авто', 1);

INSERT INTO task (name, is_completed, file_path, end_date, user_id, project_id) VALUES
('Собеседование в IT компании', 0, '', '2022-09-17', 1, 3),
('Выполнить тестовое задание', 0, '', '2022-09-16', 1, 3),
('Сделать задание первого раздела', 1, '', '2019-12-21', 1, 2),
('Встреча с другом', 0, '', '2022-12-21', 1, 1),
('Купить корм для кота', 0, '', NULL, 1, 4),
('Заказать пиццу', 0, '', NULL, 1, 4);

-- получить список из всех проектов для одного пользователя;
SELECT * FROM poject WHERE user_id = 1;
-- получить список из всех задач для одного проекта;
SELECT * FROM task WHERE poject_id = 3;
-- пометить задачу как выполненную;
UPDATE task SET is_completed = 1 WHERE id = 1;
-- обновить название задачи по её идентификатору;
UPDATE task SET name = 'Собеседование в it компании' WHERE id = 1;
