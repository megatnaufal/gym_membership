-- Migration: Remove shop tables
-- Date: 2026-07-20
-- Description: Drops order_items, orders, and products tables
--              as the shop module has been removed from the application.

-- Drop in correct order to respect foreign key constraints
DROP TABLE IF EXISTS `order_items`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `products`;
