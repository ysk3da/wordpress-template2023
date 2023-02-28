import { defineConfig } from "vite";
import path from "path";
import glob from "glob";

const entries = {};
const srcDir = "./src/client";
const distDir = `./dist/js`;

const srcFileKeys = glob.sync("**/*.+(js|ts)", { cwd: srcDir });
srcFileKeys.map((key) => {
  const srcFilepath = path.join(srcDir, key);
  entries[key] = srcFilepath;
  console.log(entries[key]);
});

export default defineConfig({
  build: {
    outDir: distDir,
    emptyOutDir: true,
    assetsDir: "",
    // manifest: true,
    rollupOptions: {
      input: entries,
      output: {
        entryFileNames: '[name]',// hashの削除
      }
    },
  },
  // optional
	// alias: {
  //   "@": "./src/scripts",
  // },
});