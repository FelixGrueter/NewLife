#!/usr/bin/env bash
set -e

echo "▶ Deploy DEV gestartet..."

# Sicherstellen, dass wir committed sind
if ! git diff --quiet || ! git diff --cached --quiet; then
  echo "❌ Nicht alle Änderungen sind committed!"
  exit 1
fi

# Optional: sicherstellen, dass main aktuell ist
git pull --rebase

# Deploy per rsync
rsync -av --delete \
  --exclude=".git" \
  --exclude=".vscode" \
  --exclude="node_modules" \
  --exclude=".DS_Store" \
  --exclude="deploy-dev.sh" \
  --exclude="config.php" \
  ./ \
  ssh-w0215e47@w0215e47.kasserver.com:/www/htdocs/w0215e47/newlife-international.org/

echo "🔧 Setze korrekte Berechtigungen auf dem Server (Verzeichnisse: 755, Dateien: 644)..."
ssh ssh-w0215e47@w0215e47.kasserver.com "find /www/htdocs/w0215e47/newlife-international.org/ -type d -exec chmod 755 {} \+ && find /www/htdocs/w0215e47/newlife-international.org/ -type f -exec chmod 644 {} \+"

echo "✅ Deploy DEV abgeschlossen"