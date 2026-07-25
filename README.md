# TAU SEN 306 — Multi-User Task Board

A Laravel web application for managing projects and tasks, built for the SEN 306 assignment at Thomas Adewumi University.

## Demo Video

Watch the demo here: [https://drive.google.com/file/d/1HMsX4Q0kNC3o-pablY3-LEfXchfpcXJm/view?usp=sharing](https://drive.google.com/file/d/1HMsX4Q0kNC3o-pablY3-LEfXchfpcXJm/view?usp=sharing)

The video demonstrates:
- Creating a task under a project
- Changing a task status to Done (with on-screen completion alert)
- Attempting unauthorized access to another user's project (403 Forbidden)

## Features

**Milestone 1 — Authentication & CRUD**
- User registration, login, and logout (Laravel Breeze)
- Full CRUD for Projects and Tasks
- Tasks include a status field (To Do, In Progress, Done)

**Milestone 2 — Validation & Security**
- Form Request validation on Project and Task inputs
- Authorization Policies restricting users to their own data
- Unauthorized access returns a 403 Forbidden response

**Milestone 3 — Filtering & Notifications**
- Filter tasks by status (All / To Do / In Progress / Done)
- On-screen alert when a task is marked Done
- Graceful error handling on failed form submissions

## Tech Stack

- Laravel 13
- Breeze (Blade + Alpine.js)
- SQLite
- Tailwind CSS