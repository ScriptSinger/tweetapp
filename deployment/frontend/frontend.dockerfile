FROM node:20

# Рабочая директория
WORKDIR /app

# Копируем package.json + lock и устанавливаем зависимости
COPY ./frontend/package*.json ./
RUN npm install



# Меняем владельца файлов (если нужно при сборке)
RUN chown -R node:node /app

# Переключаемся на пользователя node
USER node

# Запуск dev-сервера Vite
CMD ["npm", "run", "dev", "--", "--host"]
