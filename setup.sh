#!/bin/bash

DB="EventConnect"
USER="user"

echo "Importando DB EventConnect..."

mysql -u "$USER" -p "$DB" < EventConnect.sql

if [ $? -eq 0 ]; then
    echo "Importada DB correctamente"
else
    echo "Error"
    exit 1
fi


echo "Importando eventStateUpdater..."

mysql -u "$USER" -p "$DB" < eventStateUpdater.sql

if [ $? -eq 0 ]; then
    echo "eventStateUpdater creado correctamente"
else
    echo "Error al crear eventStateUpdater"
    exit 1
fi


echo "Listo"