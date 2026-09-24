#!/usr/bin/env bash
# Assemble the deployable site in dist/.
# site/        hand-written pages, copied as-is
# projects/    only the static, browser-viewable parts are copied in; large
#              notebooks, raw data, PHP and Android sources stay on GitHub.
set -euo pipefail

cd "$(dirname "$0")/.."
OUT=dist
P=projects

rm -rf "$OUT"
cp -R site "$OUT"

# Research dataset
mkdir -p "$OUT/files"
cp research/datasets/hokkaido-wind-speed-data.xlsx "$OUT/files/"

# MATLAB teaching material (renamed to URL-friendly names)
M="$OUT/teaching/matlab"
S="$P/matlab-control-compensators"
mkdir -p "$M"
cp "$S/Matlab codes for Example 9.1.txt"          "$M/example-9-1.txt"
cp "$S/Matlab codes for Example 9.1_PI.txt"       "$M/example-9-1-pi.txt"
cp "$S/Matlab codes for Example 9.2_Lag.txt"      "$M/example-9-2-lag.txt"
cp "$S/Matlab codes for Example 9.3_PD.txt"       "$M/example-9-3-pd.txt"
cp "$S/Matlab codes for Example 9.4_Lead.txt"     "$M/example-9-4-lead.txt"
cp "$S/Matlab codes for Example 9.5_PID.txt"      "$M/example-9-5-pid.txt"
cp "$S/Matlab codes for Example 9.6_Lag-lead.txt" "$M/example-9-6-lag-lead.txt"
cp "$S/zeta_calculation.txt"                      "$M/zeta-calculation.txt"
cp "$S/Design Process of PI, Lag, PD & Lead Compensator.pdf" "$M/compensator-design-process.pdf"

# Notebook exports (the multi-MB MapReduce Task 1/2 exports are left out)
mkdir -p "$OUT/demos/spark-inverted-index" "$OUT/demos/mapreduce-social-graph"
cp "$P/spark-inverted-index/Posts-Spark.html"         "$OUT/demos/spark-inverted-index/index.html"
cp "$P/mapreduce-social-graph/socialgraph-Task-3.html" "$OUT/demos/mapreduce-social-graph/task-3.html"

# Web programming labs (static HTML/CSS/JS), minus Bootstrap Studio project files
mkdir -p "$OUT/demos"
cp -R "$P/web-programming-labs" "$OUT/demos/web-labs"
find "$OUT/demos/web-labs" -name '*.bsdesign' -delete

echo "Built $OUT/ ($(du -sh "$OUT" | cut -f1), $(find "$OUT" -type f | wc -l) files)"
