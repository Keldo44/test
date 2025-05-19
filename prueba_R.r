# -----------------------------
# PRIMER EJERCICIO
# -----------------------------

# 2. Crear un vector de datos
dades <- c(5.9, 6.2, 8.3, 6.3, 6.1, 7.1, 7.0, 7.6, 4.8, 3.5, 4.0, 6.3, 7.9, 8.0)

# 3. Visualizar el contenido del vector
dades

# 4. Calcular la media manualmente (también se puede calcular así, pero usaremos funciones más abajo)
media_manual <- sum(dades) / length(dades)
media_manual

# 5. Suma de todos los valores
sum(dades)

# 6. Longitud del vector
length(dades)

# 7. Calcular la media con fórmula
sum(dades) / length(dades)

# 8. Calcular la media con función
mean(dades)

# 9. Varianza sin corregir (poblacional)
sum((dades - mean(dades))^2) / length(dades)

# 10. Varianza corregida (muestral)
var(dades)

# 11. Cálculo manual de varianza corregida
sum((dades - mean(dades))^2) / (length(dades) - 1)

# 12. Ordenar los datos
sort(dades)

# 13–14. Calcular la mediana
median(dades)

# 15–17. Cuartiles
quantile(dades, c(0.25))  # Primer cuartil
quantile(dades, c(0.75))  # Tercer cuartil

# 18. Boxplot (diagrama de caja)
boxplot(dades)

# 19. Crear nuevo vector con diez veces el número 3
dades2 <- rep(3, 10)
dades2

# Media y varianza del nuevo vector
mean(dades2)
var(dades2)

# -----------------------------
# SEGUNDO EJERCICIO
# -----------------------------

# 1. Calcular manualmente una probabilidad binomial (por ejemplo, P(X=0))
choose(12, 0) * (1/6)^0 * (1 - 1/6)^(12 - 0)

# 2–3. Calcular todas las probabilidades de una binomial Bin(12, 1/6)
nums <- 0:12
probabilidades <- dbinom(nums, size = 12, prob = 1/6)
probabilidades

# 4. Verificar que suman 1
sum(probabilidades)

# 5–6. Representación gráfica de la distribución
plot(nums, probabilidades, type = "h", main = "Distribución Binomial Bin(12, 1/6)", xlab = "x", ylab = "P(X = x)")
lines(nums, probabilidades)

# -----------------------------
# TERCER EJERCICIO
# -----------------------------

# 1. Calcular probabilidades manuales de Geom(1/6) para x=1 a x=9
nums_geo <- 1:9
prob_geo_manual <- (1/6) * (1 - 1/6)^(nums_geo - 1)
prob_geo_manual

# 2. Usar dgeom para calcular lo mismo (dgeom cuenta "fallos antes del primer éxito")
nums_dgeom <- 0:8
prob_geo_func <- dgeom(nums_dgeom, prob = 1/6)
prob_geo_func

# 3. Representación gráfica de la distribución geométrica
plot(nums_geo, prob_geo_manual, type = "h", main = "Distribución Geométrica Geom(1/6)", xlab = "x (intento en que sale un 5)", ylab = "Probabilidad")
lines(nums_geo, prob_geo_manual)

# -----------------------------
# CUARTO EJERCICIO
# -----------------------------

# Probabilidad de obtener entre 8 y 12 puntuaciones pares al lanzar 20 dados (Bin(20, 0.5))
nums_par <- 8:12
prob_par <- dbinom(nums_par, size = 20, prob = 0.5)
prob_par
sum(prob_par)  # Resultado total
