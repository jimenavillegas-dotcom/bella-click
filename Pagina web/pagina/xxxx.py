import re

# Texto de entrada
texto = "rburgoynec\tRey\tBurgoyne\trburgoynec@unicef.org"

# Expresión regular para detectar dominios .org
regex_org = r"@(\w+)\.org$"

# Buscar coincidencias
match = re.search(regex_org, texto)

if match:
    print(f"✅ El correo pertenece a una organización humanitaria ({match.group(1)})")
else:
    print("❌ El correo NO pertenece a una organización humanitaria")
