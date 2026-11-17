# 📘 Glosario de Comandos Git

## 🔹 Configuración inicial
- `git config --global user.name "Tu Nombre"`  
  Configura el nombre del usuario en Git (global).  

- `git config --global user.email "tuemail@example.com"`  
  Configura el correo electrónico del usuario en Git (global).  

- `git config --list`  
  Muestra la configuración actual de Git.  

---

## 🔹 Crear y clonar repositorios
- `git init`  
  Inicializa un nuevo repositorio Git en la carpeta actual.  

- `git clone <url>`  
  Clona un repositorio remoto en tu equipo.  

---

## 🔹 Estado y seguimiento de cambios
- `git status`  
  Muestra el estado de los archivos (modificados, nuevos, preparados).  

- `git add <archivo>`  
  Añade un archivo al área de preparación (staging).  

- `git add .`  
  Añade todos los cambios al área de preparación.  

- `git commit -m "mensaje"`  
  Crea un commit con los cambios preparados y un mensaje descriptivo.  

- `git commit --amend`  
  Modifica el último commit (puede cambiar su mensaje y/o añadir cambios nuevos).  
  Útil para corregir un commit reciente sin crear uno nuevo.  

- `git log`  
  Muestra el historial de commits.  

- `git log --oneline --graph`  
  Muestra el historial resumido y en forma de gráfico.  

- `git diff`  
  Muestra las diferencias entre el directorio de trabajo y el último commit.  

- `git diff --staged`  
  Muestra las diferencias de lo que está en staging respecto al último commit.  

---

## 🔹 Ramas
- `git branch`  
  Lista todas las ramas del repositorio.  

- `git branch <nombre>`  
  Crea una nueva rama.  

- `git checkout <rama>`  
  Cambia a otra rama.  

- `git checkout -b <rama>`  
  Crea una rama nueva y cambia a ella.  

- `git switch <rama>`  
  Cambia de rama (alternativa moderna a `checkout`).  

- `git switch -c <rama>`  
  Crea y cambia a una nueva rama.  

---

## 🔹 Fusionar y reescribir historial
- `git merge <rama>`  
  Fusiona una rama en la actual.  

- `git rebase <rama>`  
  Reaplica los commits de la rama actual sobre la rama indicada, reescribiendo la historia.  

- `git cherry-pick <hash>`  
  Aplica un commit específico en la rama actual.  

---

## 🔹 Guardar y recuperar cambios
- `git stash`  
  Guarda temporalmente los cambios no confirmados.  

- `git stash pop`  
  Recupera los cambios guardados en el stash y los elimina de la lista.  

- `git stash list`  
  Muestra la lista de cambios guardados con `stash`.  

---

## 🔹 Deshacer cambios
- `git reset <archivo>`  
  Quita un archivo del área de preparación (staging).  

- `git restore <archivo>`  
  Restaura un archivo a la última versión del commit.  

- `git reset --hard <hash>`  
  Restaura el proyecto a un commit específico (¡cuidado, se pierden cambios!).  

- `git revert <hash>`  
  Crea un nuevo commit que revierte un commit específico.  

---

## 🔹 Trabajo con remoto
- `git remote -v`  
  Muestra las conexiones remotas del repositorio.  

- `git remote add origin <url>`  
  Añade un repositorio remoto con nombre `origin`.  

- `git push origin <rama>`  
  Sube los commits de la rama actual al repositorio remoto.  

- `git pull origin <rama>`  
  Descarga y fusiona los cambios desde el remoto.  

- `git fetch`  
  Descarga los cambios del remoto pero **no los fusiona**.  

---

## 🔹 Otros útiles
- `git rm <archivo>`  
  Elimina un archivo del repositorio y del sistema de archivos.  

- `git mv <antiguo> <nuevo>`  
  Renombra o mueve un archivo.  

- `git show <hash>`  
  Muestra detalles de un commit específico.  

- `git blame <archivo>`  
  Muestra quién modificó cada línea de un archivo y en qué commit.  


