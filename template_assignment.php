<!-- template_assignment.php -->
<p dir='ltr' style='text-align: left;'></p>

<!-- HEADING Section -->
<p><strong>UNIDAD</strong></p>
<p><?php echo $COURSE_LONG; ?><br>
    <?php echo $UNIT_CODE; ?> | <?php echo $UNIT_NAME; ?><br>
    <?php echo $UNIT_SUMMARY; ?><br></p>
<p><br></p>

<!-- INSTRUCTIONS Section -->
<p><strong>INSTRUCCIONES</strong></p>
<p><?php echo $INSTRUCTIONS; ?></p>
<p><br></p>

<!-- CONCEPTS Section -->
<p><strong>CONCEPTOS</strong></p>
<p>
    <?php foreach ($CONCEPTOS as $CONCEPTO) : ?>
        <?php echo $convertToBold($CONCEPTO); ?><br />
    <?php endforeach; ?>
</p>

<!-- ESCENARIO Section -->
<p><br></p>
<p><strong>ESCENARIO</strong></p>
<p><?php echo $ESCENARIO; ?></p>
<p><br></p>

<!-- PASOS DE INVESTIGACIÓN Section -->
<p><strong>PASOS DE INVESTIGACIÓN</strong></p>
<ol>
    <?php foreach ($STEPS as $step) : ?>
        <li><?php echo htmlspecialchars($step); ?></li>
    <?php endforeach; ?>
</ol>
<p><br></p>

<!-- RECOMENDACIONES Section -->
<p><strong>RECOMENDACIONES | Técnicas, Contextuales y Herramientas Sugeridas</strong></p>
<ol>
    <?php foreach ($Recommendations as $Recommendation) : ?>
        <li><?php echo htmlspecialchars($Recommendation); ?></li>
    <?php endforeach; ?>
</ol>
<p><br></p>

<!-- OBJETIVO Section -->
<p><strong>OBJETIVO</strong></p>
<p><?php echo $OBJETIVO; ?></p>
<p><br></p>

<!-- AUTO-REVISIÓN FINAL Section -->
<p><strong>AUTO-REVISIÓN FINAL</strong></p>
<ol>
    <?php foreach ($Reflections as $Reflection) : ?>
        <li><?php echo htmlspecialchars($Reflection); ?></li>
    <?php endforeach; ?>
</ol>
<p><br></p>

<!-- ENTREGA Section -->
<strong>ENTREGA | PARA CADA CONCEPTO</strong><br>
<ul>
    <li>Hechos</li>
    <li>Contexto</li>
    <li>2 ejemplos con casos concretos</li>
    <li>Situación concreta o imaginaria con análisis</li>
    <li>Caso concreto o imaginario con evaluación</li>
    <li>Bibliografía utilizada: Libros, autores y páginas y/o URLs específicas<strong> PARA CADA CONCEPTO</strong></li>
    <br>
    <li>Debes crear una carpeta con los archivos, y subirla a Google Drive, Dropbox, Onedrive, o la nube de tu preferencia. En el módulo de entrega del proyecto, debes compartir el link del mismo. <strong>MUY IMPORTANTE</strong>: Asegúrate de que el link sea público. En caso de no poder acceder por ser privado, se considerará que el proyecto no fue entregado.</span><br></li>
</ul>
<p></p><br>
<p></p>
<p></p>
