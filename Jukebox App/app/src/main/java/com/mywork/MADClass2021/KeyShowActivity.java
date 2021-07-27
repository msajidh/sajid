package com.mywork.MADClass2021;

import androidx.appcompat.app.AppCompatActivity;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.widget.TextView;

public class KeyShowActivity extends AppCompatActivity {

    TextView detailsShow;
    public static final String store_key = "key";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_key_show);

        detailsShow = findViewById(R.id.detailsShow);
        String codeWithText = getIntent().getExtras().get("key").toString();
        detailsShow.setText(codeWithText);
        putPref(store_key, extractTokenFromString(codeWithText));
    }

    private String extractTokenFromString(String value) {
        String tokenKey;
        tokenKey = value.replaceAll("[^0-9]", ""); //extract token key from string
        System.out.println(tokenKey); //contains only token key number in tokenKey variable
        return tokenKey;
    }

    public  void putPref(String key, String value) {
        SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(this);
        SharedPreferences.Editor editor = prefs.edit();
        editor.putString(key, value);
        editor.commit();
    }

    public  String getPref(String key) {
        SharedPreferences preferences = PreferenceManager.getDefaultSharedPreferences(this);
        return preferences.getString(key, null);
    }
}