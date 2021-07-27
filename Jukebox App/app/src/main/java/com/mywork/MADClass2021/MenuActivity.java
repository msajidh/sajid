package com.mywork.MADClass2021;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;

public class MenuActivity extends AppCompatActivity {
    private TextView detailsShow;
    private Button btn;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu);
        String codeWithText = getIntent().getExtras().get("key").toString();
        detailsShow = findViewById(R.id.detailsShow);
        detailsShow.setText(codeWithText);
        Toast.makeText(MenuActivity.this, "Authentication Successful", Toast.LENGTH_LONG).show();

        btn = findViewById(R.id.btn_jukebox);
        btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(MenuActivity.this, JukeBoxActivity.class);
                i.putExtra("key",codeWithText);
                startActivity(i);
            }
        });
    }


    public String getTagValue(String xmlText, String tagName) {

        String[] firstParts = xmlText.split("<" + tagName + ">");
        String[] secondParts = firstParts[1].split("</" + tagName + ">");
        System.out.println(firstParts);
        System.out.println(secondParts);
        return secondParts[0];
    }
}